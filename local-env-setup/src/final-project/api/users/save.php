<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use DB\DB;
DB::setDbName('final-project');

class UsersSave {

    public function save() {
        $data = json_decode(file_get_contents('php://input'), 1);
        $username = $data['username'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = sprintf("INSERT INTO users (username, password) VALUES('%s', '%s')", $username, $password);

        DB::run($sql);
    }
}


(new UsersSave())->save();