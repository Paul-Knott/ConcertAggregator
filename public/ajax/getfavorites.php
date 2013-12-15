<?php

/***********************************************************************
 * File: getfavorites.php
 * Author: PK
 * Date: 03/12/13 14:53
 * 
 * Description: Get User Favorites if user is logged in
 *********************************************************************/

require_once '/home/protected/concertaggregator/stdlib.php';

if(isset($_POST["token"]))
{
    // instantiate required classes
    $session = new session($_POST["token"]);
    $page = new page();

    if($session->isLoggedIn())
    {
        $db = new db();
        $user = new user($session,$db);

        $concert["name"] = "Favorites";
        $concert["id"] = " fav";
        $concert["isFav"] = true;
        $concert["description"] = "drag & drop videos to rearrange";

        // get favorites
        foreach ($user->getFavorites() as $videodata)
        {
            $video["id"] = $videodata["vid"];
            $video["name"] = $videodata["song"];
            $video["song"] = $videodata["song"];
            $video["owner"] = $videodata["channel"];
            $video["artist"] = $videodata["artist"];
            $video["thumbnail"] = $videodata["thumbnail"];
            $video["isFav"] = true;

            $concert["videos"][] = $video;
            $session->addVideo($video);
        }

        // render favorites
        if(count($concert["videos"]) > 0)
        {
            $page->addTemplate("concert",$concert);
            $page->render();
        }
    }
}
