<?php
class DatabaseWrapper {
    private $connection;

    public function openDatabaseConnection()
    {
        $dbhost = "104.248.125.41:3306";
        $dbuser = "root";
        $dbpass = "root_password";
        $dbname = "final_project_epuce";

        try {
            $this->connection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() .PHP_EOL;
            die();
        }
    }

    public function execute($sql)
    {
        $response = $this->connection->query($sql);

        if ($response) {
            return $response;
        }
    }

    public function closeDatabaseConnection() {
        $this->connection = null;
    }

}