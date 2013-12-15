<?php

/***********************************************************************
 * File: jsonSongs.php
 * Author: PK
 * Date: 23/11/13 11:28
 * 
 * Description: jsonSongs holds json song data
 *********************************************************************/
 
 class jsonSongs extends json
 {
     private $array;

     /**
      * Searches for songs by Artist MBID and organises relevant JSON data into an array
      * @param $artistID - Artist MBID
      */
     public function __construct($artistID)
     {
         $this->getJSON("http://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&limit=50&api_key=".LASTFM_KEY."&format=json&mbid=".urlencode($artistID));

         if(is_array($this->data["toptracks"]["track"]))
         {
             foreach($this->data["toptracks"]["track"] as $songdata)
             {
                 $name = $songdata["name"];

                 $this->array[] = array(
                    "name" => $name
                 );
             }
         }
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