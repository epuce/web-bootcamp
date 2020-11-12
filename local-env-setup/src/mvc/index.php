<?php
    if (isset($_GET["page"])) {
        $file = __DIR__ . "/controllers/" . $_GET["page"] . "Controller.php";
        session_start();

        if (file_exists($file)) {
            if ($_GET["page"] === 'login' || $_GET["page"] === 'register') {
                require_once $file;
            } else if (isset($_SESSION["id"])) {
                require_once $file;
            } else {
                Header("Location: /mvc/?page=login");
            }
        } else {
            Header("Location: /mvc/?page=login");
        }
    }
?>