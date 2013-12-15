<?php

/***********************************************************************
 * File: site.php
 * Author: PK
 * Date: 20/11/13 10:58
 * 
 * Description: site class, handles the structure of the site
 *********************************************************************/

class site
{
    private $header;
    private $footer;
    private $page;
    private $user;
    private $token;

    /**
     * renders the site
     */
    public function render()
    {
        include $this->header;
        $this->page->render();
        include $this->footer;
    }

    /**
     * generates a token to uniquely identify the instance of the site
     */
    public function generateToken()
    {
        $this->token = uniqid();
    }

    /**
     * returns the site token
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Sets site header template
     * @param $file - filename of the header
     */
    public function setHeader($file)
    {
        $this->header = $file;
    }

    /**
     * Sets the site footer template
     * @param $file - filename of the template
     */
    public function setFooter($file)
    {
        $this->footer = $file;
    }

    /**
     * Sets the page of the site
     * @param page $page - page class
     */
    public function setPage(page $page)
    {
        $this->page = $page;
    }

    /**
     * Inserts user class into local scope for user details
     * @param user $user - user class
     */
    public function setUser(user $user)
    {
        $this->user = $user;
    }
}
?>