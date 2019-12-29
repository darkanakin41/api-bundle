<?php

namespace Darkanakin41\ApiBundle\Client;

use Darkanakin41\ApiBundle\Client\AbstractClient;

class EAClient extends AbstractClient
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

        $final_url = $url;

        if(!is_null($this->getApplicationKey())){
            $link = "?";
            if (stripos($final_url, $link) !== FALSE) {
                $link = "&";
            }
            $final_url .= $link . "key=" . $this->getApplicationKey();
        }

        $ch = curl_init($final_url);
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
