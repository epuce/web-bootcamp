<?php
    if (strpos($_SERVER["REQUEST_URI"], '/final-project/') === 0) {
        if (preg_match('/^\/api/', $_SERVER["REQUEST_URI"])) {
            $path = $_SERVER["SCRIPT_NAME"];
            require_once(__DIR__."/final-project/$path");
        } else if (preg_match('/^[^\.]+$/', $_SERVER["REQUEST_URI"])) {
            echo file_get_contents(__DIR__."/final-project/public/index.html");
        } else {
            $path = explode('/', $_SERVER["REQUEST_URI"]);
            echo file_get_contents(__DIR__."/final-project/public/".end($path));
        }
    } else {
        switch ($_SERVER["REQUEST_URI"]) {
            case "/CRUD/":
            case "/CRUD":
                require_once __DIR__ . "/examples/CRUD/controllers/index.php";
            break;
            case "/CRUD/add":
            case "/CRUD/add/":
                require_once __DIR__ . "/examples/CRUD/controllers/add.php";
            break;
            case preg_match('/^[^\examples]+$/', $_SERVER["REQUEST_URI"]):
                require_once __DIR__ . "/examples/web-bootcamp-app/public/index.html";
            break;
                
            default:
                echo "<h1 style='text-align: center'>404 page not found</h1>";
                echo phpinfo();
            break;
        }
    }
