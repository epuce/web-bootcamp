<?php 
session_start();
if ($_GET["token"] !== $_SESSION["edit_access_token"]) {
    header("Location: /CRUD/");
}

require_once "./models/UsersModel.php";
$name = '';
$password = '';
$id = '';

if (isset($_POST["submit"])){
    $data = [
        "name" => $_POST["name"],
        "password" => $_POST["password"],
        "id" => $_POST["id"],
    ];
    UserModel::updateUser($data);
    header("Location: /CRUD");
}

if (isset($_GET["id"])) {
    $result = UserModel::getUserById($_GET["id"]);

    while($row = mysqli_fetch_assoc($result)) {
        $name = $row["name"];
        $password = $row["password"];
        $id = $row["id"];
    }
}

$edit = true;
require_once "./views/users-form.php"
?>

