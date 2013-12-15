<?php

/***********************************************************************
 * File: getvideoinfo.php
 * Author: PK
 * Date: 30/11/13 16:17
 * 
 * Description: displays video owner under video
 *********************************************************************/

 require_once '/home/protected/concertaggregator/stdlib.php';

 if(isset($_POST["id"]) && isset($_POST["token"]))
 {
     // instantiate required classes
     $page = new page();
     $session = new session($_POST["token"]);

     // get video info
     $video =  $session->getVideo($_POST["id"]);

    // render video info
    $page->addTemplate("videoinfo",$video);
    $page->render();

 }