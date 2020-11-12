<?php 
    require_once __DIR__ . "/../../database-wrapper.php";
    $token = $_GET['token']; 

    $tokenExists = DB::run("SELECT * FROM tokens WHERE token = '$token'")->fetch_assoc();

    if ($tokenExists) { 
        echo "You can access this site";
    } else {
        Header("Location: /mvc/?page=list");
    }
?>