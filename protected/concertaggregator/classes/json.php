<?php

/***********************************************************************
 * File: json.php
 * Author: PK
 * Date: 23/11/13 12:11
 * 
 * Description: abstract json class, handles JSON requests
 *********************************************************************/
 
 abstract class json
 {
     protected $data;

     /**
      * Gets JSON data and stores it in private $data array
      * @param $url
      */
     protected function getJSON($url)
     {
         $data = @file_get_contents($url);

         if($data === FALSE)
         {
             error("Could Not Connect to JSON URL, Please Try Again Later");
             exit;
         }
         else
         {
             $this->data = json_decode($data,true);
         }

     }

 }