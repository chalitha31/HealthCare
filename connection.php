<?php

class Database
{

    public static $connection;

    public static function SetUpConnection()
    {

        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "Chalithac*#3031", "healthcare", "3306");
        }
    }

    public static function iud($q)
    {

        Database::SetUpConnection();
        Database::$connection->query($q);
    }

    public static function search($q)
    {

        Database::SetUpConnection();
        return Database::$connection->query($q);
    }
}
