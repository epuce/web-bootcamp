<?php
    if (isset($_GET["page"])) {
        require_once __DIR__ . "/controllers/" . $_GET["page"] . "Controller.php";
    }
?>