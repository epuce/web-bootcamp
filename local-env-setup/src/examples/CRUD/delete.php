<?php 
    if (isset($_GET["id"])) {
        require_once "./models/UsersModel.php";
        UserModel::deleteUserById($_GET["id"]);
    }

    if (isset($_GET["redirect"]) && $_GET["redirect"] === "false") {
        return;
    }

    header("Location: /CRUD/");
?>