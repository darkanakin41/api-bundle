<?php
namespace PLejeune\ApiBundle\EndPoint\Google;


use PLejeune\ApiBundle\EndPoint\AbstractEndPoint;

class YoutubeEndPoint extends AbstractEndPoint
{
    const URL = "https://www.googleapis.com/youtube/v3/";

    public function getChannelId($channel_name)
    {

        $query = http_build_query(array(
            "part" => "id",
            "forUsername" => $channel_name,
        ));

        $result = $this->getClient()->execute(self::URL . "channels?" . $query);

        return json_decode($result);
    }

    public function getChannelName($channel_id)
    {

        $query = http_build_query(array(
            "part" => "snippet",
            "id" => $channel_id,
        ));

        $result = $this->getClient()->execute(self::URL . "channels?" . $query);

        return json_decode($result);
    }

    public function getLastVideos($channel_id)
    {

        $query = http_build_query(array(
            "part" => "id,snippet",
            "maxResults" => "20",
            "order" => "date",
            "type" => "video",
            "channelId" => $channel_id,
        ));

        $result = $this->getClient()->execute(self::URL . "search?" . $query);

        return json_decode($result);
    }

    /**
     * Retrieve all data from the given video ids
     * @param string|string[] $channel_id id of the channel to update (can be multiple, must be separated by comas)
     * @return \stdClass
     */
    public function getVideoData($channel_id)
    {
        if(is_array($channel_id)){
            $search = implode(",", $channel_id);
        }else{
            $search = $channel_id;
        }
        $query = http_build_query(array(
            "part" => "id,snippet,liveStreamingDetails",
            "id" => $search,
        ));

        $result = $this->getClient()->execute(self::URL . "videos?" . $query);

        return json_decode($result);
    }

    /**
     * Retrieve all data from the given video ids
     * @param integer $max the max amount of videos to retrieve
     * @return \stdClass
     */
    public function getVideoFeatured($live = false, $max = 50, $order_by = "viewCount")
    {
        $url_parameters = array(
            "part" => "id,snippet,liveStreamingDetails",
            "videoCategoryId" => "20",
            "maxResults" => $max,
            "type" => "video",
            "order" => $order_by,
        );
        if($live){
            $url_parameters["eventType"] = "live";
        }
        $query = http_build_query($url_parameters);

        $result = $this->getClient()->execute(self::URL . "search?" . $query);

        return json_decode($result);
    }

}