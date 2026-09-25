<?php
session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/users/userController.php';

$page = $_GET['page'] ?? 'dashboard';

$pdo = connect();

$userController = new UserController($pdo);

switch ($page) {
    case 'login':
        $userController->showLogin();
        break;

    case 'loginUser':
        $userController->login();
        break;

    case 'signup':
        $userController->showSignup();
        break;

    case 'signupUser':
        $userController->signup();
        break;

    case 'logout':
        $userController->logout();
        break;

    case 'home':
        $userController->home();
}