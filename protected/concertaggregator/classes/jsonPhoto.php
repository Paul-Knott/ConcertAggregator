<?php

/***********************************************************************
 * File: jsonPhoto.php
 * Author: PK
 * Date: 23/11/13 12:42
 * 
 * Description: jsonPhoto recieves Artist MBID and returns Artist Photo url
 *********************************************************************/

class jsonPhoto extends json
{
    private $photo;

    /**
     * Searches for Artist photo by Artist MBID and stores url in a variable
     * @param $id
     */
    public function __construct($id)
    {
        $this->getJSON("http://ws.audioscrobbler.com/2.0/?method=artist.getInfo&format=json&api_key=".LASTFM_KEY."&mbid=".$id);
        $this->photo = $this->data["artist"]["image"][2]["#text"];
    }

    /**
     * Returns Photo URL of the Artist or placeholder if none found
     * @return string
     */
    public function getPhoto()
    {
        if(isset($this->photo))
        {
            return $this->photo;
        }
        else
        {
            return "img/user.png";
        }
    }

}