<?php

/***********************************************************************
 * File: setphoto.php
 * Author: PK
 * Date: 30/11/13 13:24
 * 
 * Description: sets artist photo in search bar
 *********************************************************************/

require_once '/home/protected/concertaggregator/stdlib.php';

 if(isset($_POST["token"]))
 {
     // instantiate required classes
     $session = new session($_POST["token"]);
     $photo = new jsonPhoto($session->getArtist("id"));

     // return photo url
     exit($photo->getPhoto());

 }