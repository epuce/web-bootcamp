<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use DB\DB;
DB::setDbName("final-project");

session_start();

$isUserActive = $_COOKIE['user_id'] || $_SESSION["user_id"];

$data = ["is_session_active" => $isUserActive];

if ($isUserActive) {
    $user = DB::run("SELECT id, username FROM users WHERE id=" . $_SESSION["user_id"])->fetch_assoc();
    $data["user"] = $user;
}


echo json_encode($data);