<?php

/***********************************************************************
 * File: setconcert.php
 * Author: PK
 * Date: 21/11/13 15:41
 * 
 * Description: recursively set concert items via ajax request
 *********************************************************************/

require_once '/home/protected/concertaggregator/stdlib.php';

if(isset($_POST["token"]) && isset($_POST["row"]))
{
    // instantiate required classes
    $page = new page();
    $session = new session($_POST["token"]);

    // get required data
    $row = $_POST["row"];
    $name = $session->getArtist("name");
    $concert = $session->getConcert($row);
    $city = $concert["city"];
    $cityname = reset(explode(',',$city));
    $date = $concert["date"];
    $date1 = $date->format("Y-m-d\T00:00:00.000\Z");
    $date2 = clone $date;
    $date2 = $date2->add(new DateInterval('P90D'));
    $date2 = $date2->format("Y-m-d\T00:00:00.000\Z");
    $videolist = new jsonVideos($name,$cityname,$date2,$date1);

    // find videos
    foreach($session->getArtist("songs") as $song)
    {
        $video = $videolist->getVideo($song["name"]);

        if(is_array($video))
        {
            if($session->isLoggedIn())
            {
                $db = new db();
                $user = new user($session,$db);
                $video["isFav"] = $user->isFavorite($video);
            }

            $video["song"] = $song["name"];
            $video["name"] = $song["name"];
            $video["artist"] = $name;
            $video["concert"]["city"] = $city;
            $video["concert"]["date"] = $date;

            $concert["name"] = $city;
            $concert["id"] = $row;
            $concert["videos"][$video["id"]] = $video;

            $session->addVideo($video);
        }

    }

    if(count($concert["videos"]) > 0)
    {
        $page->addTemplate("concert",$concert);
    }

    // render concert and move to next concert in list
    print round(++$row / count($session->getArtist("concerts")) * 100)."|";
    if($row < count($session->getArtist("concerts")))
    {
        $page->render();
    }
    else
    {
        print count($session->getArtist("videos"));
    }
}