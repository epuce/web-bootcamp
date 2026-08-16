<?php
require_once __DIR__ . '/../../helpers/db.php';
require_once __DIR__ . '/../../models/UserModel.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel = new UserModel(db());
    $user = $userModel->getUserByName($_POST['name'] ?? '');

    if ($user === null) {
        $message = 'No user with this login';
    } elseif (password_verify($_POST['password'] ?? '', $user['password'])) {
        session_start();
        $_SESSION['id'] = $user['id'];
        $message = 'You have been logged in';
    } else {
        $message = 'Wrong password';
    }
}

require __DIR__ . '/../../views/login-form.php';
