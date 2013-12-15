<?php

/***********************************************************************
 * File: setlists.php
 * Author: PK
 * Date: 28/11/13 21:41
 * 
 * Description: add song & concert lists to Artist Object
 *********************************************************************/

require_once '/home/protected/concertaggregator/stdlib.php';

if(isset($_POST["token"]))
{
    // instantiate required classes
    $session = new session($_POST["token"]);

    // get required data
    $artistID = $session->getArtist("id");
    $songdata = new jsonSongs($artistID);
    if(!is_array($songdata->getArray()))
    {
        exit("0");
    }

    $concertdata = new jsonConcerts($artistID);
    if(!is_array($concertdata->getArray()))
    {
        exit("0");
    }

    // save required data
    $session->setArtist("songs",$songdata->getArray());
    $session->setArtist("concerts",$concertdata->getArray());
    exit("1");
}

