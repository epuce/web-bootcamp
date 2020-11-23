<?php

require_once __DIR__ . "/../../../vendor/autoload.php";
use DB\DB;

class ProductGet {
    public function show(){
        $sql = "SELECT * FROM products WHERE id = " . $_GET["id"];

        $response = DB::run($sql);

        if ($response) {
            $product = $response->fetch_assoc();
        } else {
            $product = [];
        }

        echo json_encode($product);
    }
}

(new ProductGet())->show();