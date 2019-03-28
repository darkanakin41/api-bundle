<?php

namespace PLejeune\ApiBundle\Service;


use PLejeune\ApiBundle\EndPoint\AbstractEndPoint;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

class ApiService
{
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Get the selected endpoint
     *
     * @param string $clientName
     * @param string $endpointName
     *
     * @return AbstractEndPoint
     *
     * @throws \Exception
     */
    public function getEndPoint($clientName, $endpointName)
    {
        $clientClassname = sprintf('PLejeune\\ApiBundle\\Client\\%sClient', ucfirst($clientName));
        if (!class_exists($clientClassname)) throw new \Exception('unhandled_client');
        $clientObject = new $clientClassname();

        if (!isset($this->config['clients'][strtolower($clientName)])) throw new \Exception('client_configuration_missing');
        $converter = new CamelCaseToSnakeCaseNameConverter();
        foreach ($this->config['clients'][strtolower($clientName)] as $key => $value) {
            $method = sprintf('set%s', ucfirst($converter->denormalize($key)));
            if (!method_exists($clientObject, $method)) continue;
            call_user_func([$clientObject, $method], $value);
        }

        $endpointClassname = sprintf('PLejeune\\ApiBundle\\EndPoint\\%s\\%sEndPoint', ucfirst($clientName), ucfirst($endpointName));
        if (!class_exists($endpointClassname)) throw new \Exception('unhandled_endpoint');
        $endpointObject = new $endpointClassname();
        $endpointObject->setClient($clientObject);

        return $endpointObject;
    }
}
