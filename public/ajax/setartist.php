<?php

/***********************************************************************
 * File: setartist.php
 * Author: PK
 * Date: 22/11/13 19:26
 * 
 * Description: instantiate artist via search request then get concert & song lists
 *********************************************************************/


require_once '/home/protected/concertaggregator/stdlib.php';

if(isset($_POST["artist"]) && isset($_POST["token"]))
{
    // instantiate required classes
    $session = new session($_POST["token"]);

    // get required data
    $name = htmlspecialchars(trim($_POST["artist"]));
    $json = new jsonArtist($name);
    $artist = $json->getArray();
    $session->Artist($artist);

    // return data
    ($artist["id"]) ? exit("1") : exit("0");

}
