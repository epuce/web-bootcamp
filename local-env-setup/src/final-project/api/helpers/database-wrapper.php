<?php
class DatabaseWrapper {
    private static $connection = null;

    private static function openConnection($dbname = NULL)
    {
        $dbhost = "104.248.125.41:3306";
        $dbuser = "root";
        $dbpass = "root_password";
        $dbname = "final_project_epuce";

        static::$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        if (static::$connection->connect_error) {
            throw("Connection failed: " . static::$connection->connect_error);
        }
    }

    private static function closeConnection()
    {
        static::$connection->close();
        static::$connection = null;
    }

    public static function execute($sql)
    {
        if(!static::$connection) {
            static::openConnection();
        }

        $response = static::$connection->query($sql);

        if ($response === TRUE) {
            $response = static::$connection->insert_id;
        }
        
        static::closeConnection();

        if (static::$connection->error) {
            throw("SQL error: " . static::$connection->error . "</br>");
        } else {
            return $response;
        }
    }

    public static function getArrayResult($sql) {
        $result = self::execute($sql);
        $response = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }

        return json_encode($response);;
    }
}