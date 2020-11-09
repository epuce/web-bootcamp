<?php
class DB {
    private static $connection;

    private static function openConnection()
    {
        $dbhost = "mysql-server-80";
        $dbuser = "root";
        $dbpass = "root_password";
        $dbname = "shop";

        static::$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

        if (static::$connection->connect_error) {
            die(
                "Connection failed: " . 
                static::$connection->connect_error
            );
        }
    }

    private static function closeConnection()
    {
        static::$connection->close();
        static::$connection = null;
    }

    public static function run($sql)
    {
        if(!static::$connection) {
            static::openConnection();
        }

        $response = static::$connection->query($sql);

        if ($response === TRUE) {
            $response = static::$connection->insert_id;
        }
        
        if (static::$connection->error) {
            die("SQL error: " . static::$connection->error . "</br>");
        } else {
            return $response;
        }

        static::closeConnection();
    }
}

// zend_extension = "C:/xampp/php/ext/php_xdebug.dll"
// xdebug.remote_enable = 1
// xdebug.remote_autostart = on

// restart apache
// add xdebug extension to VSCODE - "PHP debug"
// add xdebug extension to Chrome - "Xdebug helper"

// C:/xampp/php/php.ini