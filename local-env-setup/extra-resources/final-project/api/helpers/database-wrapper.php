<?php
class DatabaseWrapper {
    private static $connection = null;

    private static function openDatabaseConnection()
    {
        $dbhost = "104.248.125.41:3306";
        $dbuser = "root";
        $dbpass = "root_password";
        $dbname = "final_project_epuce";

        try {
            static::$connection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() .PHP_EOL;
            die();
        }
    }

    public static function execute($sql)
    {
        if (is_null(static::$connection)) {
            static::openDatabaseConnection();    
        }

        $response = static::$connection->query($sql)->fetchAll(\PDO::FETCH_ASSOC);            

        static::closeDatabaseConnection();

        echo json_encode($response);
    }

    private static function closeDatabaseConnection() {
        static::$connection = null;
    }

}