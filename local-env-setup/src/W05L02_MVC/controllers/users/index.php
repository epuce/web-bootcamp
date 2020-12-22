<?php
include_once '../../helpers/database-wrapper.php';

// Make your model available
include '../../models/UserModel.php';

// Create an instance
$userModel = new UserModel();
$users = $userModel->getAllUsers();

// Show the view
include '../../views/user-list.php';