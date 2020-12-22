<?php

namespace MVC\controllers;

require_once __DIR__ . "/../../vendor/autoload.php";

use DB\DB;
use MVC\components\UserForm;

class loginController {
    public function validateLogin() {
        $error = null;

        if (!empty($_POST["email"])) {
            $email = $_POST["email"];

            $sql = "SELECT * FROM users WHERE email = '$email'";

            $response = DB::run($sql)->fetch_assoc();

            if ($response) {
                if (!empty($_POST["password"])) {
                    $isValidPassword = password_verify(
                        $_POST["password"],
                        $response["password"]
                    );

                    if (!$isValidPassword) {
                        $error = "Invalid password";
                    }
                } else {
                    $error = "Password not set";
                }
            } else {
                $error = "User with email: '$email' does not exist";
            }
        } else {
            $error = "Email not specified";
        }

        return $error;
    }

    public function login() {
        $error = $this->validateLogin();

        if (!$error) {
            session_start();
            $_SESSION["id"] = $_POST["email"];
            Header("Location: /mvc/?page=list");
        } else {
            echo $error;
        }
    }

    public function html()
    {
        $this->login();

        $form = new UserForm();
        $form->setBtnText("Login");
        $form->html();
    }
}

(new loginController())->html();
