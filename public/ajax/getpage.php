<?php

/***********************************************************************
 * File: getpage.php
 * Author: PK
 * Date: 30/11/13 22:09
 * 
 * Description: get page via ajax request
 *********************************************************************/

require_once '/home/protected/concertaggregator/stdlib.php';

if(isset($_POST["page"]))
{
    $page = new page();
    $page->addTemplate(strtolower($_POST["page"]));
    $page->render();
}