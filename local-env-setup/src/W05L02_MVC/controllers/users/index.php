<?php
require_once __DIR__ . '/../../helpers/db.php';
require_once __DIR__ . '/../../models/UserModel.php';

$userModel = new UserModel(db());
$users = $userModel->getAllUsers();

// Show the view
require __DIR__ . '/../../views/user-list.php';
