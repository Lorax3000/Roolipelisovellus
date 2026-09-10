<?php
session_start();

require_once __DIR__ . '/models/db.php';
require_once __DIR__ . '/controllers/homeController.php';

$page = $_GET['page'] ?? 'home';

$controller = new homeController();

$pdo = connect();

switch($page) {
    case 'register':
        $controller->showRegister();
        break;
    case 'login':
        $controller->showLogin();
        break;
    case 'registerUser':
        $controller->registerUser($pdo);
        break;
    case 'loginUser':
        $controller->loginUser($pdo);
        break;
    case 'logout':
        $controller->logout();
        break;
}