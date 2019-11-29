<?php

namespace PLejeune\ApiBundle\EndPoint\Ea;

use PLejeune\ApiBundle\EndPoint\AbstractEndPoint;

class CardEndPoint extends AbstractEndPoint
{
    const URL = 'https://www.easports.com/fr/fifa/ultimate-team/api/fut/item';

    public function getCards($page = 1){
        $query = http_build_query(array(
            "jsonParamObject" => json_encode(array("page" => $page)),
        ));

        $result = $this->getClient()->execute(self::URL . "?" . $query);

        return json_decode($result);
    }

    /**
     * Retrieve cards for given player
     * @return mixed
     */
    public function getCardPlayer($player_id)
    {

        $query = http_build_query(array(
            "jsonParamObject" => json_encode(array("baseid" => $player_id)),
        ));

        $result = $this->getClient()->execute(self::URL . "?" . $query);

        return json_decode($result);
    }
}