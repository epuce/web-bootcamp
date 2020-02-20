<?php
class DatabaseWrapper {
    private $connection;

    public function openDatabaseConnection($dbname = NULL)
    {
        $dbhost = "104.248.125.41:3306";
        $dbuser = "root";
        $dbpass = "root_password";

        if ($dbname) {
            //mysqli_connect
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        } else {
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass);
        }

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        } else {
            echo "All good!!!";
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
            die("SQL error: " . $this->connection->error . "</br>");
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