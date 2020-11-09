<?php
    require_once __DIR__ . "/../views/listView.php";
    require_once __DIR__ . "/../models/listModel.php";

    $model = new listModel();
    $products = $model->getAll();

    $view = new listView($products);
    $view->html();
?>