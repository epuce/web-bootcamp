<?php
if (isset($_POST['create'])) {
	include_once '../../../helpers/database-wrapper.php';
	include_once '../../../models/UserModel.php';
	include_once '../../../entity/User.php';

	$userModel = new UserModel();
	$user = new User();

	$user->setName($_POST['name']);
	$user->setProfession($_POST['profession']);

	$userModel->createUser($user);

	header("Location: " . $_ENV['HOSTNAME'] . "/users");
}

// Show the view
include '../../../views/user-form.php';