<?php

/***********************************************************************
 * File: jsonConcerts.php
 * Author: PK
 * Date: 23/11/13 15:03
 * 
 * Description: jsonConcerts extends json, holds Concert data
 *********************************************************************/
 
 class jsonConcerts extends json
 {
     private $array;

     /**
      * Requires Artist MBID and organises relevant JSON data into an array
      * @param $artistid
      */
     public function __construct($artistid)
     {
         $this->getJSON('http://api.songkick.com/api/3.0/artists/mbid:'.$artistid.'/gigography.json?order=desc&apikey='.SONGKICK_KEY);

         if(is_array($this->data["resultsPage"]["results"]["event"]))
         {
             foreach($this->data["resultsPage"]["results"]["event"] as $concertdata)
             {
                 $date = new dateTime($concertdata["start"]["date"]);
                 $city = $concertdata["location"]["city"];
                 $key = preg_replace('/[\W]+/', '_', $date->format("YM").reset(explode(',',$city)));;

                 $this->array[$key] = array(
                     "city" => $city,
                     "date" => $date
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
