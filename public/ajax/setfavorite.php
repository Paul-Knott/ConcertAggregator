<?php

/***********************************************************************
 * File: setfavorite.php
 * Author: PK
 * Date: 04/12/13 13:25
 * 
 * Description: Adds/Removes Favorite Video
 *********************************************************************/

require_once '/home/protected/concertaggregator/stdlib.php';

 if(isset($_POST["token"]) && isset($_POST["vid"]))
 {
     // instantiate required classes
     $db = new db();
     $session = new session($_POST["token"]);
     $user = new user($session,$db);

     // get required data
     $video = $session->getVideo($_POST["vid"]);
     $user->setFavorite($video);

     if($video["isFav"])
     {
         $video["isFav"] = false;
         $favClass = "glyphicon-star-empty";
     }
     else
     {
         $video["isFav"] = true;
         $favClass = "glyphicon-star";
     }

     // render favorite icon
     $session->addVideo($video);
     print '<span class="glyphicon '.$favClass.'"></span>';

 }