<?php
include_once '../../helpers/database-wrapper.php';

$db = new DatabaseWrapper();
$db->openDatabaseConnection();

// Make your model available
include '../../models/UserModel.php';

// Create an instance
$userModel = new UserModel($db);
$users = $userModel->getAllUsers();

// Show the view
include '../../views/user-list.php';