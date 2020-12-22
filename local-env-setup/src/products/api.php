<?php
    require_once __DIR__ . "/../database-wrapper.php";

    $dbhost = "mysql-server-80:3306";
    $dbuser = "root";
    $dbpass = "root_password";
    $dbname = "shop";
    $dbConnection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
    if ($_GET["table"]) {
        $table = $_GET["table"];
        $sql = "SELECT * FROM $table";

        $response = [];
        
        $sqlResponse = $dbConnection->query($sql);
        
        if ($sqlResponse) {
            $response = $sqlResponse->fetch_all(MYSQLI_ASSOC);
        } else {
            $response = ["error" => "missing table: " . $_GET["table"]];
        }

        echo json_encode($response);
    }

    if ($_GET['product_name']) {
        $productName = $_GET['product_name'];
        $sql = "SELECT * FROM products WHERE name='$productName'";

        $response = DB::run($sql)->fetch_assoc();

        echo json_encode(["products" => $response]);
    }
?>