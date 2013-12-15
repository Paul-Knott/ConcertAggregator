<?php

/***********************************************************************
 * File: session.php
 * Author: PK
 * Date: 02/12/13 21:39
 * 
 * Description: session class, handles session data
 *********************************************************************/
 
class session
{
    private $artist;
    private $token;

    /**
     * Requires a token which uniquely identifies every page
     * so session data isnt accidently overwritten by another search request
     * maximum 10 tokens per user to prevent flooding of requests
     * @param $token - page token
     */
    public function __construct($token)
    {
        session_start();

        $this->token = $token;
        $this->artist = &$_SESSION[$this->token];

        // limit user to 10 tokens to prevent flooding
        if(count($_SESSION) > 10)
        {
            foreach($_SESSION as $key => $value)
            {
                if(strlen($key) > 2)
                {
                    unset($_SESSION[$key]);
                    break;
                }
            }
        }
    }

    /**
     * Stores new artist details (overwrites previously stored artist data)
     * @param array $artist - artist data stored in array
     */
    public function Artist(array $artist)
    {
        $this->artist = $artist;
    }

    /**
     * Sets specific details of the artist
     * @param $key - Name of data
     * @param $value - Data to insert
     */
    public function setArtist($key,$value)
    {
        $this->artist[$key] = $value;
    }

    /**
     * Returns requested artist data
     * @param $key - Name of Data
     * @return mixed - Data requested
     */
    public function getArtist($key)
    {
        return $this->artist[$key];
    }

    /**
     * Returns the nth concert in the concert array
     * @param $n - Row number
     * @return array - Concert data array
     */
    public function getConcert($n)
    {
        return reset(array_slice($this->artist["concerts"],$n,1));
    }

    /**
     * Adds a video to artist video list
     * @param array $video - Array of video data
     */
    public function addVideo(array $video)
    {
        $this->artist["videos"][$video["id"]] = $video;
    }

    /**
     * Returns video data of the requested ID
     * @param $id - Youtube video ID
     * @return array - Video data array
     */
    public function getVideo($id)
    {
        return $this->artist["videos"][$id];
    }

    /**
     * Checks if user is logged in
     * @return bool true/false - if logged in or not
     */
    public function isLoggedIn()
    {
        if (isset($_SESSION["id"]))
        {
            return true;
        }
        return false;
    }

    /**
     * stores user ID to identify user successfully logged in
     * @param $id - ID of the user
     */
    public function auth($id)
    {
        $_SESSION["id"] = $id;
    }

    /**
     * displays previously stored alert from another page
     */
    public function getAlert()
    {
        if(isset($_SESSION["msg"]["msg"]))
        {
            $type = $_SESSION["msg"]["type"];
            $msg =  $_SESSION["msg"]["msg"];
            include PROTECTED_ROOT."/templates/alert.php";
            unset($_SESSION["msg"]);
        }
    }

    /**
     * Sets an alert, ready to be shown on another page
     * @param $type error/success - type of alert
     * @param $msg - message to be shown
     */
    public function alert($type,$msg)
    {
        if($type != "success" && $type != "error")
        {
            error("invalid alert type specified, valid ones are: success, error");
        }
        else
        {
            $_SESSION["msg"]["type"] = $type;
            $_SESSION["msg"]["msg"] = $msg;
        }
    }

    /**
     * clears specific session data
     * @param $key - Name of stored data
     */
    public function clear($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Stores specified data in session
     * @param $key - name of data
     * @param $value - data to store
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Returns requested data stored in session
     * @param $key - name of data
     * @return mixed - data stored
     */
    public function get($key)
    {
        return $_SESSION[$key];
    }
}