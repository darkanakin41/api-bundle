<?php

namespace PLejeune\ApiBundle\Client;

use PLejeune\ApiBundle\Client\AbstractClient;

class GoogleClient extends AbstractClient
{
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
        );

        $options = $default_parameters + $parameters;

        $link = "?";
        if (stripos($url, $link) !== FALSE) {
            $link = "&";
        }

        $ch = curl_init($url . $link . "key=" . $this->getApplicationKey());
        curl_setopt_array($ch, $options);

        $result = curl_exec($ch);

        $error = curl_error($ch);
        curl_close($ch);
        if (!empty($error)) {
            throw new \Exception($error);
        }

        return $result;
    }
}