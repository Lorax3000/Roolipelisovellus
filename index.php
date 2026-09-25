<?php
session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/characters/characterController.php';
require_once __DIR__ . '/users/userController.php';

$page = $_GET['page'] ?? 'dashboard';

$pdo = connect();

$characterController = new CharacterController($pdo);
$userController = new UserController($pdo);

switch ($page) {

    case 'dashboard':
        $characterController->dashboard();
        break;

    case 'showCreateCharacter':
        $characterController->showCreateCharacter();
        break;

    case 'createCharacter':
        $characterController->createCharacter();
        break;

    case 'showCharacter':
        $id = $_GET['id'];
        $characterController->showCharacter($id);
        break;

    case 'showEditCharacter':
        $id = $_GET['id'];
        $characterController->showEditCharacter($id);
        break;

    case 'editCharacter':
        $characterController->editCharacter();
        break;

    case 'deleteCharacter':
        $characterController->deleteCharacter();
        break;

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

    default:
        $characterController->dashboard();
        break;
}