<?php

/***********************************************************************
 * File: user.php
 * Author: PK
 * Date: 01/12/13 10:30
 * 
 * Description: user class, handles user data and favorites
 *********************************************************************/
 
 class user
 {
     private $id;
     private $session;
     private $db;

     /**
      * Retrieves user data and favorites, requires session and db class
      * @param session $session - session class
      * @param db $db - db class
      */
     public function __construct(session $session, db $db)
     {
         $this->session = $session;
         $this->id = $session->get("id");
         $this->db = $db;
     }

     /**
      * Returns User ID
      * @return int ID
      */
     public function getID()
     {
         return $this->id;
     }

     /**
      * Returns an Array of Favorited Videos
      * @return array - An array of Favorited Videos
      */
     public function getFavorites()
     {
          return $this->db->query("SELECT * FROM favs WHERE uid=? ORDER BY sort ASC",$this->id);
     }

     /**
      * Adds video to user favorites
      * @param $video - video array
      */
     public function setFavorite($video)
     {
          if($video["isFav"])
          {
              $this->db->query("DELETE FROM favs WHERE uid=? AND vid=?",$this->getID(),$video["id"]);
          }
          else
          {
              $query = $this->db->query("SELECT sort FROM favs WHERE uid=? ORDER BY sort DESC LIMIT 1",$this->getID());
              $order = 1;
              if(is_numeric($query[0]["sort"]))
              {
                  $order += $query[0]["sort"];
              }

              $this->db->query("INSERT INTO favs VALUES ('',?,?,?,?,?,?,?)",$this->getID(),$video["id"],$video["song"],$video["thumbnail"],$video["artist"],$video["owner"],$order);
          }
     }

     /**
      * Checks video is favorited
      * @param $video - video data array
      * @return bool true/false - depending on whether video is favorited
      */
     public function isFavorite($video)
     {
         $result = $this->db->query("SELECT * FROM favs WHERE uid=? AND vid=? ORDER BY sort ASC",$this->id,$video["id"]);

         if($result)
         {
             return true;
         }
         return false;
     }

     /**
      * Returns user email address
      * @return email address
      */
     public function getEmail()
     {
        $rows = $this->db->query("SELECT * FROM users WHERE id=?",$this->id);

        return $rows[0]["email"];
     }

 }