<?php
require_once "database_config.php";
class Database
{

    public static $connection;

    public static function SetUpConnection()
    {

        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
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
