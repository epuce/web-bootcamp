<?php

if (isset($_POST['login'])) {
	include_once '../../helpers/database-wrapper.php';
	include_once '../../models/UserModel.php';

	$db = new DatabaseWrapper();
	$db->openDatabaseConnection();

	$userModel = new UserModel($db);

	$users = $userModel->getUser($_POST);

	$result = $db->responseToArray($users);

	var_dump($_SESSION);

	if (!json_decode($result, true)[0]) {
		echo "No user with this login";
	} else if (password_verify($_POST['password'] . 'salt', json_decode($result, true)[0]['password'])) {
		echo "You have been logged in";

		session_start();
		$_SESSION['id'] = json_decode($result, true)[0]['id'];

		var_dump($_SESSION);
	} else {
		echo "Wrong password";
	}
}

include '../../views/login-form.php';