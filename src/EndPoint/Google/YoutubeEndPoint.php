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

        return json_decode($result, true);
    }

    public function getChannelData($channel_id)
    {
        $query = http_build_query(array(
            "part" => "snippet",
            "id" => $channel_id,
        ));

        $result = $this->getClient()->execute(self::URL . "channels?" . $query);

        return json_decode($result, true);
    }

    /**
     * Retrieve Live Broadcasts
     *
     * @param string $broadcastType
     * @param string $pageToken
     * @param int $maxResults
     * @return array[]
     */
    public function liveBroadcasts($broadcastType, $pageToken = null, $maxResults = 50)
    {
        $queryParameters = [
            "part" => "id,snippet,contentDetails,status",
            "broadcastType" => $broadcastType,
            "maxResults" => $maxResults,
        ];
        if($pageToken !== null) $queryParameters['pageToken'] = $pageToken;

        $query = http_build_query($queryParameters);

        $result = $this->getClient()->execute(self::URL . "liveBroadcasts?" . $query);

        return json_decode($result, true);
    }

    public function getChannelVideos($channel_id, $maxResults = 50)
    {

        $query = http_build_query(array(
            "part" => "id,snippet",
            "maxResults" => $maxResults,
            "order" => "date",
            "type" => "video",
            "channelId" => $channel_id,
        ));

        $result = $this->getClient()->execute(self::URL . "search?" . $query);

        return json_decode($result, true);
    }

    /**
     * Retrieve all data from the given video ids
     * @param string[] $channel_id id of channels to update
     * @return array
     */
    public function getVideosData(array $channel_id, $maxResults = 50)
    {
        $search = implode(",", $channel_id);
        $query = http_build_query(array(
            "part" => "id,snippet,liveStreamingDetails",
            "maxResults" => $maxResults,
            "id" => $search,
        ));

        $result = $this->getClient()->execute(self::URL . "videos?" . $query);

        return json_decode($result, true);
    }

    /**
     * Retrieve all data from the given video ids
     * @param integer $max the max amount of videos to retrieve
     * @return array
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

        return json_decode($result, true);
    }

}
