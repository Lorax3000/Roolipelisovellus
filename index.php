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

    if ($page === 'kampanja') {

    $action = $_POST['action'] ?? $_GET['action'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        switch ($action) {

            case 'create':
                $KampanjaController->createKampanja();
                break;

            case 'update':
                $KampanjaController->updateKampanja();
                break;

            case 'delete':
                $KampanjaController->deleteKampanja();
                break;

            case 'addPlayer':
                $KampanjaController->addPlayer();
                break;

            case 'updatePlayerStatus':
                $KampanjaController->updatePlayerStatus();
                break;

            case 'deletePlayer':
                $KampanjaController->deletePlayer();
                break;

            case 'addNote':
                $KampanjaController->addNote();
                break;

            case 'updateNote':
                $KampanjaController->updateNote();
                break;

            case 'deleteNote':
                $KampanjaController->deleteNote();
                break;

            default:
                $KampanjaController->index();
                break;
        }

    } else {

        switch ($action) {

            case 'create':
                $KampanjaController->createForm();
                break;

            case 'edit':

                $id = $_GET['id'] ?? null;

                if (!$id) {
                    die('Kampanjan ID puuttuu.');
                }

                $KampanjaController->editForm($id);
                break;

            case 'show':

                $id = $_GET['id'] ?? null;

                if (!$id) {
                    die('Kampanjan ID puuttuu.');
                }

                $KampanjaController->showKampanja($id);
                break;

            default:
                $KampanjaController->index();
                break;
        }
    }

    exit;
}
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

    case 'index':
        $KampanjaController->index();
        break;

    default:
        $characterController->dashboard();
        break;
}