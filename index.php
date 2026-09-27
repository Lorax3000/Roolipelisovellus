<?php

session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/characters/characterController.php';
require_once __DIR__ . '/users/userController.php';
require_once __DIR__ . '/campaigns/kampanjaController.php';


$page = $_GET['page'] ?? 'dashboard';

$pdo = connect();

$KampanjaController = new KampanjaController($pdo);

if ($page === 'kampanja') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $action = $_POST['action'] ?? '';

        if ($action === 'create') {

            $KampanjaController->createKampanja();

        }

        elseif ($action === 'update') {

            $KampanjaController->updateKampanja();

        }

        elseif ($action === 'delete') {

            $KampanjaController->deleteKampanja();

        }

        else {

            $KampanjaController->index();

        }

    }
    else {

        $action = $_GET['action'] ?? '';

        if ($action === 'create') {

            $KampanjaController->createForm();

        }

        elseif ($action === 'edit') {

            $id = $_GET['id'] ?? null;

            if (!$id) {
                die('Kampanjan ID puuttuu.');
            }

            $KampanjaController->editForm($id);

        }

        elseif ($action === 'show') {

            $id = $_GET['id'] ?? null;

            if (!$id) {
                die('Kampanjan ID puuttuu.');
            }

            $KampanjaController->showKampanja($id);

        }

        else {

            $KampanjaController->index();

        }

    }

    exit;
}

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