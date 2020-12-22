<?php

use MVC\entity\Product;

require_once __DIR__ . "/../models/listModel.php";
    $model = new listModel();
    if (!empty($_POST["id"])) {
        // Update
        $model->updateById(
            $_POST["id"],
            $_POST["name"],
            $_POST["price"],
        );
    } else {
        // Insert
        $model->insertNew(
            $_POST["name"],
            $_POST["price"],
            $_POST["category_id"],
        );
    }

    Header("Location: /mvc/?page=list");
?>