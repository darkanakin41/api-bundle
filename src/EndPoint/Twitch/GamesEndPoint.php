<?php
namespace Darkanakin41\ApiBundle\EndPoint\Twitch;

use Darkanakin41\ApiBundle\EndPoint\AbstractEndPoint;

class GamesEndPoint extends AbstractEndPoint
{
    const URL = "https://api.twitch.tv/";

    /**
     * Retrieve game_id from the given game
     * @param string $gameName the game name
     * @return \stdClass
     */
    public function getId($gameName)
    {
        $url_parameters = [
            "name" => $gameName,
        ];
        $query = http_build_query($url_parameters);

        $result = $this->getClient()->execute(self::URL . "helix/games?" . $query);

        return json_decode($result, true);
    }

    /**
     * Retrieve game_id from the given game
     * @param string $gameId the game id
     * @return \stdClass
     */
    public function getData($gameId)
    {
        $url_parameters = [
            "id" => $gameId,
        ];
        $query = http_build_query($url_parameters);

        $result = $this->getClient()->execute(self::URL . "helix/games?" . $query);

        return json_decode($result, true);
    }

}
