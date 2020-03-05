<?php
    switch ($_SERVER["REQUEST_URI"]) {
        case "/CRUD/":
            require_once __DIR__ . "/CRUD/controllers/index.php";
        break;
        case "/CRUD/add":
            require_once __DIR__ . "/CRUD/controllers/add.php";
        break;
        default:
            echo "<h1 style='text-align: center'>404 page not found</h1>";
            echo phpinfo();
        break;
    }
?>