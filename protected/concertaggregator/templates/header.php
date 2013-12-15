<?php
/***********************************************************************
 * File: header.php
 * Author: pk
 * Date: 18/10/13 12:46
 *
 * Description: header template
 **********************************************************************/
?>

<!DOCTYPE html>
<!--suppress ALL -->

<html>

<head>
    <meta name="description" content="Concert Video Aggregator">
    <meta name="keywords" content="Concert,Video,Aggregator,HD">
    <meta name="author" content="idlesquad.net">
    <meta charset="UTF-8">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"/>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <![endif]-->

    <!--
    #
    # NO JAVASCRIPT
    #
    -->

    <noscript>
        <style type="text/css">
            #allcontainer {display:none;}
        </style>
        <p> &nbsp; </p>
        <div class="noscript alert alert-info center">
            <p><b>Sorry! This site won't work without javascript enabled.</b></p>
            <p>This site uses Javascript to control the video player and the concert playlists<br />
                Please consider enabling it.</p>
        </div>
    </noscript>

    <!--
    #
    # TITLE
    #
    -->

    <?php if (isset($title)): ?>
        <title>IdleSquad.net: <?= htmlspecialchars($title) ?></title>
    <?php else: ?>
        <title>IdleSquad.net</title>
    <?php endif ?>

</head>

<body>
<div id="allcontainer">
    <!--
    #
    # TOP NAV BAR
    #
    -->
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">IdleSquad.net</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Concert Video Aggregator</a> </li>
                    <li><a class="menu" href="#about">About</a></li>
                    <li><a class="menu" href="#contact">Contact</a></li>
                </ul>
                <?php if (isset($this->user)): ?>
                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="active"><a href="#">Logged in as: <b><?= $this->user->getEmail() ?></b></a></li>
                        <form class="userform navbar-form pull-right" method="post"><button type="submit" name="form" value="logout" class="signout-margin btn btn-small">Sign Out</button></form>
                    </ul>
                <?php else: ?>
                    <div class="nav navbar-nav navbar-right pull-right">
                        <form class="navbar-form pull-right">
                            <a href="#login" class="btn btn-default menu">Sign-in</a>
                            <a href="#register" class="btn btn-primary menu">Register</a>
                        </form>
                    </div>
                <?php endif ?>
            </div><!--/nav-collapse -->
        </div>
    </div>

    <!--
    #
    # MAIN CONTENT
    #
    -->

    <div id="content" class="content container">


