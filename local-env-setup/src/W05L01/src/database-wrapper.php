<?php

// TODO re write all the sql::run to static logic
class DatabaseWrapper {
    private static $connection;

    private static function openDatabaseConnection($dbname = NULL)
    {
        $dbhost = "104.248.125.41:3306";
        $dbuser = "root";
        $dbpass = "root_password";
        $dbname = "web-bootcamp";
        
        static::$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        if (static::$connection->connect_error) {
            die("Connection failed: " . static::$connection->connect_error);
        }
    }

    private static function closeDatabaseConnection()
    {
        static::$connection->close();
    }

    public static function run($sql)
    {
        if (!static::$connection) {
            static::openDatabaseConnection();
        }
        $response = static::$connection->query($sql);
        static::closeDatabaseConnection();

        if ($response) {
            return $response;
        } else {
            die("SQL error: " . static::$connection->error . "</br>");
        }
    }

    public function responseToArray($response)
    {
        $array = [];
        while($row = mysqli_fetch_assoc($response)) {
            $array[] = $row;
        }

        return json_encode($array);
    }
}