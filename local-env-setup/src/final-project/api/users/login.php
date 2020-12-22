<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use DB\DB;
DB::setDbName('final-project');

class UsersSave {

    public function login() {
        error_reporting(0);
        try {
            $data = $_POST;
            $username = $data['username'];
            $sql = sprintf("SELECT * FROM users WHERE username='%s'", $username);
    
            $user = DB::run($sql)->fetch_assoc();
            $response = ["valid_login" => false];
    
            if ($user) {
                $isPasswordValid = password_verify($data['password'], $user['password']);
    
                if ($isPasswordValid) {
                    session_start();
                    $_SESSION["user_id"] = $user["id"];
                    
                    $response = ["valid_login" => $user["id"]];
                }    
            }
            echo json_encode($response);
        } catch (Error $e) { 
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}

(new UsersSave())->login();