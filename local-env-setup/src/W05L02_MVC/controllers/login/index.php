<?php

if (isset($_POST['login'])) {
	include_once '../../models/UserModel.php';

	$userModel = new UserModel();

	$users = $userModel->getUser($_POST);

	$result = $db->responseToArray($users);

	if (!json_decode($result, true)[0]) {
		echo "No user with this login";
	} else if (password_verify($_POST['password'] . 'salt', json_decode($result, true)[0]['password'])) {
		echo "You have been logged in";

		session_start();
		$_SESSION['id'] = json_decode($result, true)[0]['id'];
	} else {
		echo "Wrong password";
	}
}

include '../../views/login-form.php';