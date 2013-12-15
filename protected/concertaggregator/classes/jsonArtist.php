<?php

/***********************************************************************
 * File: jsonArtist.php
 * Author: PK
 * Date: 23/11/13 12:42
 * 
 * Description: jsonArtist holds json artist data
 *********************************************************************/

class jsonArtist extends json
{
    private $array;

    /**
     * Searches for Artist by Name and organises relevant JSON data into an array
     * @param $name - Name of Artist
     */
    public function __construct($name)
    {
        $this->getJSON("http://api.songkick.com/api/3.0/search/artists.json?query=".urlencode($name)."&apikey=".SONGKICK_KEY);

        $this->array = array (
            "name"  => $name,
            "id"    => $this->data["resultsPage"]["results"]["artist"][0]["identifier"][0]["mbid"]
        );
    }

    /**
     * Returns JSON data as an organised array
     * @return array - an organised array of required JSON data
     */
    public function getArray()
    {
        return $this->array;
    }

}