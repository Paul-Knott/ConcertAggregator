<?php

/***********************************************************************
 * File: sortconcerts.php
 * Author: PK
 * Date: 29/11/13 11:47
 * 
 * Description: switch between different playlists
 *********************************************************************/

require_once '/home/protected/concertaggregator/stdlib.php';

if(isset($_POST["token"]) && isset($_POST["list"]))
{
    // instantiate required classes
    $page = new page();
    $session = new session($_POST["token"]);

    // get list of videos
    $videos = $session->getArtist("videos");

    // sort concerts
    $sort = new sort($videos);
    $by = "by".$_POST["list"];
    $list = $sort->{$by}();

    foreach($list as $concert)
    {
        $page->addTemplate("concert",$concert);
    }

    $page->render();
}