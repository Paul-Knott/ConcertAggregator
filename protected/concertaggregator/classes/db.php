<?php

/***********************************************************************
 * File: db.php
 * Author: PK
 * Date: 20/11/13 14:45
 * 
 * Description: database class, handles PDO sql queries
 *********************************************************************/

class db
{
    private $pdo;

    public function __construct()
    {
        try
        {
            // connect to database
            $this->pdo = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

            // ensure that PDO::prepare returns false when passed invalid SQL
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch (PDOException $e)
        {
            error($e->getMessage());
            exit;
        }
     }

    /**
     * Query database, returns results or false if none found
     * @param sql statement - takes complete sql statement
     * @return array|bool result - array of results or false if none found
     */
    public function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // prepare SQL statement
        $statement = $this->pdo->prepare($sql);
        if ($statement === false)
        {
            error($this->pdo->errorInfo()[2]);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }
}

 