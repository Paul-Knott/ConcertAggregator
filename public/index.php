<?php

/***********************************************************************
 * File: index.php
 * Author: PK
 * Date: 20/11/13 10:13
 * 
 * Description: home page
 *********************************************************************/

require '/home/protected/concertaggregator/stdlib.php';

// instantiate required classes
$site = new site();
initialise_site($site);
$session = new session($site->getToken());
$page = new page();

// get user info if logged in
if($session->isLoggedIn())
{
    $db = new db();
    $user = new user($session,$db);
    $site->setUser($user);
}

// render the site
$page->addTemplate("index");
$site->setPage($page);
$site->render();
$session->getAlert();

?>