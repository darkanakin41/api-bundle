<?php

namespace Darkanakin41\ApiBundle\EndPoint;


use Darkanakin41\ApiBundle\Client\AbstractClient;

abstract class AbstractEndPoint
{
    /**
     * @var AbstractClient
     */
    private $client;

    /**
     * @return AbstractClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param AbstractClient $client
     * @return AbstractEndPoint
     */
    public function setClient(AbstractClient $client)
    {
        $this->client = $client;

        if (defined(get_class($this) . "::SCOPE")) {
            $client->addScope(self::SCOPE);
        }

        return $this;
    }
}
