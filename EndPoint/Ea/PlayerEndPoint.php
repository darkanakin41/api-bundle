<?php

namespace PLejeune\ApiBundle\EndPoint\Ea;

use PLejeune\ApiBundle\EndPoint\AbstractEndPoint;

class PlayerEndPoint extends AbstractEndPoint
{
    const URL = "https://www.easports.com/fifa/ultimate-team/web-app/content/B1BA185F-AD7C-4128-8A64-746DE4EC5A82/2018/fut/items/web/players.json?_=1816";

    /**
     * Retrieve the whole list of players
     * @return mixed
     */
    public function getAll()
    {
        $result = $this->getClient()->execute(self::URL);

        return json_decode($result);
    }
}