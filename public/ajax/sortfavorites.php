<?php

/***********************************************************************
 * File: sortfavorites.php
 * Author: PK
 * Date: 07/12/13 18:03
 * 
 * Description: sorts the favorite video order
 *********************************************************************/

require_once '/home/protected/concertaggregator/stdlib.php';

if(isset($_POST["vids"]))
{
    // instantiate required classes
    $session = new session("1");
    $db = new db();
    $i = 0;

    // save the new sort order
    foreach($_POST["vids"] as $id)
    {
        $db->query("UPDATE favs SET sort=? WHERE uid=? AND vid=?",$i++,$session->get("id"),$id);
    }
}