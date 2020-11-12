<?php 
    require_once __DIR__ . "/../views/registerView.php";
    require_once __DIR__ . "/../../database-wrapper.php";

    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $salt = "#/A5ax%*9)&!@%asd";

        $password = $password . $salt;

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

        DB::run($sql);
        Header("Location: /mvc/?page=login");
    } else {
        echo "Some fields are missing";
    }

    $view = new RegisterView();
    $view->html();
?>