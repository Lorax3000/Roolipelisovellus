<?php

session_start();

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/characters/characterController.php';
require_once __DIR__ . '/users/userController.php';
require_once __DIR__ . '/campaigns/kampanjaController.php';
require_once __DIR__ . '/game/gameController.php';


$page = $_GET['page'] ?? 'dashboard';

if (
    !isset($_SESSION['user_id']) &&
    $page !== 'dashboard' &&
    $page !== 'login' &&
    $page !== 'signup' &&
    $page !== 'loginUser' &&
    $page !== 'signupUser' &&
    $page !== 'help'
) {
    header("Location: index.php?page=dashboard");
    exit;
}


$pdo = connect();

$characterController = new CharacterController($pdo);
$userController = new UserController($pdo);
$KampanjaController = new KampanjaController($pdo);

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

            case 'addCharacter':
                $KampanjaController->addCharacter();
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

            case 'archive':
                $KampanjaController->archiveKampanja();
                break;

            default:
                $KampanjaController->campaigns();
                break;
        }

    }

    else {

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

                $KampanjaController->campaigns();

                break;
        }
    }

    exit;
}

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

        $id = $_GET['id'] ?? null;

        if (!$id) {
            die('Hahmon ID puuttuu.');
        }

        $characterController->showCharacter($id);

        break;

    case 'showEditCharacter':

        $id = $_GET['id'] ?? null;

        if (!$id) {
            die('Hahmon ID puuttuu.');
        }

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

    case 'campaigns':

        $KampanjaController->campaigns();

        break;

    case 'game':
        $campaign_id = $_GET['campaign_id'] ?? null;
    
        if (!$campaign_id) {
            die('Campaign id missing.');
        }
    
        $kampanjaModel = new KampanjaModel($pdo);
        $kampanja = $kampanjaModel->getKampanja($campaign_id);
    
        if (!$kampanja) {
            die('Campaign not found.');
        }
    
        if ($kampanja['campaign_status'] === 'archived') {
            die('This campaign has been archived so the game couldnt be started.');
        }

        if ($kampanja['campaign_status'] === 'paused') {
            die('This campaign has been paused so the game couldnt be started.');
        }

        if ($kampanja['campaign_status'] === 'finished') {
            die('This campaign has finished so the game couldnt be started.');
        }
    
        $gameController = new GameController($pdo);
        $gameController->game($campaign_id);
        break;

    case 'attack':

        $campaign_id = $_POST['campaign_id'] ?? null;

        if (!$campaign_id)
        {
            die('Kampanjan ID puuttuu.');
        }

        $gameController = new GameController($pdo);

        $gameController->attack($campaign_id);

        break;

    case 'defend':

        $campaign_id = $_POST['campaign_id'] ?? null;

        if (!$campaign_id)
        {
            die('Kampanjan ID puuttuu.');
        } 

        $gameController = new GameController($pdo);

        $gameController->defend($campaign_id);

        break;

    case 'newBattle':

        $campaign_id = $_POST['campaign_id'] ?? null;

        if (!$campaign_id) {
            die('Kampanjan ID puuttuu.');
        }

        $gameController = new GameController($pdo);
        
        $gameController->newBattle($campaign_id);

        break;

    case 'invitations':

        $KampanjaController->invitations();

        break;
    
    case 'acceptInvitation':

        $KampanjaController->acceptInvitation();
        
        break;

    case 'help':

        $userController->helpPage();

        break;

    default:

        $characterController->dashboard();

        break;
}