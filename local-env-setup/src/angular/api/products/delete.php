<?php

require_once __DIR__ . "/../../../vendor/autoload.php";
use DB\DB;

class ProductDelete {
    public function show() {
        $sql = "DELETE FROM products WHERE id = " . $_POST["id"];
        DB::run($sql);
    }
}

(new ProductDelete())->show();