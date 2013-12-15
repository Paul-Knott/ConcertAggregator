<?php

/***********************************************************************
 * File: sort.php
 * Author: PK
 * Date: 29/11/13 16:33
 * 
 * Description: sort class, sorts the concerts by selected function
 *********************************************************************/
 
class sort
{
     private $videos;
     private $list;

    /**
     * Requires array of videos, sorts videos
     * @param array $videos - an array of videos
     */
    public function __construct(array $videos)
     {
        $this->videos = $videos;
        $this->list = array();
     }

    /**
     * Sorts the videos by data
     * @return array - An array of sorted videos
     */
    public function byDate()
     {
         foreach($this->videos as $video)
         {
                $key = $video["concert"]["date"]->format("Ymd");

                $video["name"] = $video["song"];

                $this->list[$key]["id"] = $key;
                $this->list[$key]["name"] = $video["concert"]["city"];
                $this->list[$key]["date"] = $video["concert"]["date"];
                $this->list[$key]["videos"][] = $video;
         }

         krsort($this->list);

         return $this->list;
     }

    /**
     * Sorts the videos by song
     * @return array - An array of sorted videos
     */
    public function bySong()
    {
        foreach($this->videos as $video)
        {
            $key = preg_replace('/[\W]+/', '_', $video["song"]);

            $video["name"] = $video["concert"]["city"];
            $video["date"] = $video["concert"]["date"];

            $this->list[$key]["id"] = $key;
            $this->list[$key]["name"] = $video["song"];
            $this->list[$key]["videos"][] = $video;
        }

        ksort($this->list);

        return $this->list;
    }

}

