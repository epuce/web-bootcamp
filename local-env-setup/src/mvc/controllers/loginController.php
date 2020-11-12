<?php 
    require_once __DIR__ . "/../components/userForm.php";
    require_once __DIR__ . "/../../database-wrapper.php";

    if (!empty($_POST["email"])) {
        $email = $_POST["email"];

        $sql = "SELECT * FROM users WHERE email = '$email'";

        $response = DB::run($sql)->fetch_assoc();

        if ($response) {
            if (!empty($_POST["password"])) {
                $salt = "#/A5ax%*9)&!@%asd";
                $password = $_POST["password"];

                $password = $password . $salt;
                
                $isValidPassword = password_verify(
                    $_POST["password"],
                    $response["password"]
                );

                if ($isValidPassword) {
                    session_start();
                    $_SESSION["id"] = $response["email"];
                    Header("Location: /mvc/?page=list");
                } else {
                    echo "Invalid password";
                }
            } else {
                echo "Password not set";
            }
        } else {
            echo "User with email: '$email' does not exist";
        }
    }

    $form = new UserForm();
    $form->setBtnText("Login");
    $form->html();
?>