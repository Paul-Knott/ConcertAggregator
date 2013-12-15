<?php

/***********************************************************************
 * File: jsonVideos.php
 * Author: PK
 * Date: 23/11/13 21:40
 * 
 * Description: jsonVideos extends json, gets and holds json video results
 *********************************************************************/

class jsonVideos extends json
{
    private $array;
    private $artist;
    private $city;

    /**
     * Searches for videos matching criteria and stores JSON video results as an array
     * @param $artist - name of artist
     * @param $city - city of concert
     * @param $datebefore - date of concert to begin search
     * @param $dateafter - date after concert to end search
     */
    public function __construct($artist,$city,$datebefore,$dateafter)
    {
        $this->artist = $artist;
        $this->city = $city;

        $this->getJSON('https://www.googleapis.com/youtube/v3/search?q="'.urlencode($artist).'"+'.urlencode($city).'&publishedBefore='.$datebefore.'&publishedAfter='.$dateafter.'&maxResults=50&type=video&order=viewcount&videoDefinition=high&videoEmbeddable=true&part=snippet&key='.GAPI_KEY);

        if(is_array($this->data["items"]))
        {
            foreach($this->data["items"] as $video)
            {
               $this->array[$video["id"]["videoId"]] = array(
                   "id"          => $video["id"]["videoId"],
                   "title"       => $video["snippet"]["title"],
                   "thumbnail"   => $video["snippet"]["thumbnails"]["high"]["url"],
                   "owner"       => $video["snippet"]["channelTitle"],
                   "publishdate" => $video["snippet"]["publishedAt"]
               );
            }
        }

    }

    /**
     * Returns video data of requested song as an array
     * @param $song - Name of the song
     * @return bool|array - returns video data or false if none found
     */
    public function getVideo($song)
    {
        if(is_array($this->array))
        {
            foreach($this->array as $video)
            {
                $searchWords = array ($this->artist, $this->city, $song);

                // search for each word in title
                $isMatch = true;
                foreach($searchWords as $word)
                {
                    // if one word not found, ignore video
                    if(stripos($video["title"], $word) === false)
                    {
                        $isMatch = false;
                        break;
                    }
                }

                if($isMatch)
                {
                    return $video;
                }
            }
        }

        return false;
    }
}