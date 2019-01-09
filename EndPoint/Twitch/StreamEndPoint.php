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
        if($cursor !== null){
            $url_parameters["after"] = $cursor;
        }
        $query = http_build_query($url_parameters);

        $result = $this->getClient()->execute(self::URL . "helix/streams?" . $query);

        return json_decode($result, true);
    }
    /**
     * Retrieve streams from the given user_login
     * @return array
     */
    public function getStream($userLogin)
    {
        $url_parameters = [
            "user_login" => $userLogin,
        ];

        $query = http_build_query($url_parameters);

        $result = $this->getClient()->execute(self::URL . "helix/streams?" . $query);

        return json_decode($result, true);
    }

}