<?php

namespace Darkanakin41\ApiBundle\Client;

use Darkanakin41\ApiBundle\Client\AbstractClient;

class TwitchClient extends AbstractClient
{
    private $clientId;

    /**
     * @param $url
     * @param $parameters
     * @return mixed
     * @throws \Exception
     */
    public function execute($url, $parameters = array())
    {
        $default_parameters = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => ['Client-ID: ' . $this->getClientId()]
        );

        $options = $default_parameters + $parameters;

        $link = "?";
        if (stripos($url, $link) !== FALSE) {
            $link = "&";
        }

        $ch = curl_init($url . $link);
        curl_setopt_array($ch, $options);

        $result = curl_exec($ch);

        $error = curl_error($ch);
        curl_close($ch);
        if (!empty($error)) {
            throw new \Exception($error);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     * @return TwitchClient
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }


}
