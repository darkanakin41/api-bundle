<?php

namespace PLejeune\ApiBundle\EndPoint\Twitch;

use PLejeune\ApiBundle\EndPoint\AbstractEndPoint;

class StreamEndPoint extends AbstractEndPoint
{
    const URL = "https://api.twitch.tv/";

    /**
     * Retrieve streams from the given game_id
     * @return array
     */
    public function getGameStreams($gameId, $cursor = null)
    {
        $url_parameters = [
            "game_id" => $gameId,
        ];
        if ($cursor !== null) {
            $url_parameters["after"] = $cursor;
        }
        $query = http_build_query($url_parameters);

        $result = $this->getClient()->execute(self::URL . "helix/streams?" . $query);

        return json_decode($result, true);
    }

    /**
     * Retrieve streams from the given user_login
     * @param array $user_logins
     * @param string $cursor the page
     * @return array
     */
    public function getStreams(array $user_logins, $cursor = null)
    {
        $data = [];
        foreach ($user_logins as $login) {
            $data[] = sprintf("user_login=%s", $login);
        }

        if ($cursor !== null) {
            $data[] = sprintf('after=%s', $cursor);
        }

        $query = implode("&", $data);

        $result = $this->getClient()->execute(self::URL . "helix/streams?" . $query);

        return json_decode($result, true);
    }

}