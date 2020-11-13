<?php

use DB\DB;
use MVC\controllers\loginController;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    public function testExample() {
        $this->assertEquals(3, 3);
    }

    public function testLoginController() {
        $loginController = new loginController();

        $error = $loginController->validateLogin();

        $this->assertEquals("Email not specified", $error);

        $email = "test@email.com";
        $password = "test_password";
        $_POST["email"] = $email;

        $error = $loginController->validateLogin();

        $this->assertEquals("User with email: '$email' does not exist", $error);

        $hasedPassword = password_hash($password, PASSWORD_DEFAULT);
        DB::run("INSERT INTO users VALUES('$email', '$hasedPassword')");

        try {
            $error = $loginController->validateLogin();
            $this->assertEquals("Password not set", $error);
    
            $_POST["password"] = "password";
            $error = $loginController->validateLogin();
    
            $this->assertEquals("Invalid password", $error);

            $_POST["password"] = $password;
            $error = $loginController->validateLogin();
    
            $this->assertEquals(null, $error);
        } finally {
            DB::run("DELETE FROM users WHERE email='$email'");
        }
    }

    public function testSomeCoolThingS() {
        
    }
}

?>