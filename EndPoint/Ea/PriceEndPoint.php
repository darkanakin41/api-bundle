<?php

namespace PLejeune\ApiBundle\EndPoint\Ea;

use PLejeune\ApiBundle\EndPoint\AbstractEndPoint;

class PriceEndPoint extends AbstractEndPoint
{
    const URL = 'https://www.easports.com/fr/fifa/ultimate-team/api/fut/price-band/';

    /**
     * Retrieve cards for given player
     * @return mixed
     */
    public function getPrice($card_id)
    {
        $result = $this->getClient()->execute(self::URL . $card_id);
        return json_decode($result);
    }
}