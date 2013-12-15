<?php

/***********************************************************************
 * File: auth.php
 * Author: PK
 * Date: 01/12/13 16:11
 * 
 * Description: processes forms via ajax request
 *********************************************************************/

require_once '/home/protected/concertaggregator/stdlib.php';

if(isset($_POST["form"]))
{
    // instantiate required classes
    $db = new db();
    $session = new session("1");
    $auth = new auth($db,$session);

    // get required data
    $action = $_POST["form"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // authenticate
    switch($action)
    {
        case "login"    : $submit = $auth->login($email,$password); break;
        case "register" : $submit = $auth->register($email,$password); $action = "registration"; break;
        case "logout"   : $submit = $auth->logout(); break;
        default         : $submit = false;
    }

    if($submit)
    {
        $session->alert("success",ucfirst($action)." Successful");
        exit("1");
    }
    else
    {
        exit("0");
    }
}