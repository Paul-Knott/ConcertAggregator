<?php

/***********************************************************************
 * File: auth.php
 * Author: PK
 * Date: 03/12/13 21:44
 * 
 * Description: auth class, handles user authentication
 *********************************************************************/
 
 class auth
 {
     private $db;
     private $session;

     public function __construct(db $db, session $session)
     {
         $this->db = $db;
         $this->session = $session;

     }

     /**
      * Logs in user
      * @param $email - email address
      * @param $password - password
      * @return bool true/false - based on success
      */
     public function login($email,$password)
     {
         $email = trim($email);
         $password = trim($password);

         if(empty($email) || empty($password))
         {
             error("You must provide your email and password");
         }
         else
         {
             // query database for user
             $rows = $this->db->query("SELECT * FROM users WHERE email = ?", strtolower($email));

             // if we found user, check password
             if(count($rows) == 1)
             {
                 $row = $rows[0];

                 // if hash is correct, set session id
                 if(password_verify($password, $row["hash"]))
                 {
                     $this->session->auth($row["id"]);
                     return true;
                 }
                 else
                 {
                     error("Invalid email or password");
                 }
             }
             else
             {
                 error("Invalid email or password");
             }
         }

         return false;

     }

     /**
      * Logs out the user
      * @return bool true/false - based on success
      */
     public function logout()
     {
         $this->session->clear("id");
         return true;
     }

     /**
      * Registers the user
      * @param $email - email address
      * @param $password - password
      * @return bool true/false - based on success
      */
     public function register($email,$password)
     {
         $email = trim($email);
         $password = trim($password);

         if(empty($email) || empty($password))
         {
             error("You must provide an email and password");
         }
         else
         {
             $validEmail = $this->checkEmail($email);
             $validPassword = $this->checkPassword($password);

             if($validEmail && $validPassword)
             {
                 $hash = password_hash($password, PASSWORD_DEFAULT);
                 if(!$hash)
                 {
                     error("Error inserting Password into Database");
                     exit;
                 }

                 $result = $this->db->query("INSERT INTO users (email,hash) VALUES(?,?)",strtolower($email),$hash);
                 if($result === false)
                 {
                     error("Error inserting into Database");
                 }
                 else
                 {
                     $this->login($email,$password);
                     return true;
                 }
             }
         }
         return false;
     }


     /**
      * Checks password is valid
      * @param $password - the users password
      * @return bool true/false - depending on validity
      */
     private function checkPassword($password)
     {
         if(strlen($password) > 5)
         {
             return true;
         }
         else
         {
             error("Password must be 6 or more characters");
             return false;
         }
     }

     /**
      * Checks Email is valid
      * @param $email - users email
      * @return bool true/false - depending on validity
      */
     private function checkEmail($email)
     {
         if (filter_var($email, FILTER_VALIDATE_EMAIL))
         {

             $rows = $this->db->query("SELECT email FROM users WHERE email=?",$email);

             if($rows)
             {
                 error('Email has already been registered before');
                 return false;
             }
             else
             {
                 return true;
             }
         }
         else
         {
             error('Please enter a valid email address');
             return false;
         }
     }





 }