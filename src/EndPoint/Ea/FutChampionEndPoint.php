<?php

namespace Darkanakin41\ApiBundle\EndPoint\Ea;

use Darkanakin41\ApiBundle\EndPoint\AbstractEndPoint;

class FutChampionEndPoint extends AbstractEndPoint
{
    const URL = 'https://www.easports.com/cgw/api/fifa/fut/';

    /**
     * Retrieve classement for given plateform and region
     * @param string $plateform the plateform
     * @param string $region the region
     * @return array
     */
    public function getClassement($plateform, $region)
    {
        $result = $this->getClient()->execute(self::URL . sprintf("leaderboard?platform=%s&region=%s&period=curr", $plateform, $region));
        return json_decode($result);
    }
}
