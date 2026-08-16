<?php
require_once __DIR__ . '/../../../helpers/db.php';
require_once __DIR__ . '/../../../models/UserModel.php';
require_once __DIR__ . '/../../../entity/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $user->setName($_POST['name'] ?? '');
    $user->setProfession($_POST['profession'] ?? '');

    // Store the password hashed (password_hash salts it for us), never in plain text
    $userModel = new UserModel(db());
    $userModel->createUser($user, password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT));

    header('Location: /users');
    exit;
}

// Show the view
require __DIR__ . '/../../../views/user-form.php';
