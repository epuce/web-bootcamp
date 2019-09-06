<?php
    // $ php -S localhost:8000 -t path/to/folder

    function OpenCon()
    {
        $dbhost = "104.248.125.41:3306";
        $dbuser = "mintos_user";
        $dbpass = "mintos";
        $db = "mintos_task";
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

        return $conn;
    }

    function CloseCon($conn)
    {
        $conn->close();
    }

    $connection = OpenCon();
    
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
       
    $sql = "SELECT * FROM `user`";

    $result = $connection->query($sql);

    $rows = [];

    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    print json_encode($rows);

    CloseCon($connection);