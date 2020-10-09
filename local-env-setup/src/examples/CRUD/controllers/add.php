<?php

use CRUD\entity\User;
$edit = false;

var_dump($_POST);
var_dump(isset($_POST["submit"]));

if (isset($_POST["submit"])){
    require_once __DIR__ . "/../models/UsersModel.php";
    require_once __DIR__ . "/../entity/User.php";

    $user2 = new User($_POST);

    UserModel::addUser($user2);

    header("Location: /CRUD");
}

require_once __DIR__ . "/../views/users-form.php"
?>
