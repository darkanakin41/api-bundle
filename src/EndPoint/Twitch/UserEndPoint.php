<?php

namespace Darkanakin41\ApiBundle\EndPoint\Twitch;

use Darkanakin41\ApiBundle\EndPoint\AbstractEndPoint;

class UserEndPoint extends AbstractEndPoint
{
    const URL = "https://api.twitch.tv/";


    /**
     * Retrieve streams from the given user_login
     * @param array $userLogins
     * @param string $cursor the page
     * @return array
     */
    public function getUsers(array $userLogins, $cursor = null)
    {
        $data = [];
        foreach ($userLogins as $login) {
            $data[] = sprintf("login=%s", mb_convert_encoding ($login, "UTF-8"));
        }

        if ($cursor !== null) {
            $data[] = sprintf('after=%s', $cursor);
        }

        $result = $this->getClient()->execute(self::URL . "helix/users?" . implode("&", $data));

        return json_decode($result, true);
    }

}
