<?php
class DatabaseWrapper {
    private $connection;

    public function openDatabaseConnection($dbname = NULL)
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "root_password";

        if ($dbname) {
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        } else {
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass);
        }

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function closeDatabaseConnection()
    {
        $this->connection->close();
    }

    public function execute($sql)
    {
        $response = $this->connection->query($sql);

        if ($response) {
            return $response;
        } else {
            die("SQL error: " . $this->connection->error);
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