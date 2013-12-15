<?php

/***********************************************************************
 * File: stdlib.php
 * Author: PK
 * Date: 21/11/13 14:22
 *
 * Description: standard config for entire site, included in every page
 *********************************************************************/

// constant vars
require_once "constants.php";

function __autoload($class)
{
    include PROTECTED_ROOT."/classes/$class.php";
}

function initialise_site(site $site)
{
    $site->setHeader(PROTECTED_ROOT."/templates/header.php");
    $site->setFooter(PROTECTED_ROOT."/templates/footer.php");
    $site->generateToken();
}

function error($msg)
{
    $type = "error";
    include PROTECTED_ROOT."/templates/alert.php";
    exit;
}


?>