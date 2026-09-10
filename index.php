<?php
session_start();

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/characters/characterController.php';

$page = $_GET['page'] ?? 'home';

$pdo = connect();

$characterController = new CharacterController($pdo);

switch ($page) {

    case 'createCharacter':
        $characterController->createCharacter();
        break;
    
    case 'showCreateCharacter':
        $characterController->showCreateCharacter();
        break;

    case 'showEditCharacter':
        $id = $_GET['id'];
        $characterController->showEditCharacter($id);
        break;

    case 'showCharacter':
        $id = $_GET['id'];
        $characterController->showCharacter($id);
        break;

    case 'deleteCharacter':
        $characterController->deleteCharacter();
        break;

    case 'dashboard':
        $characterController->dashboard();
        break;
    
    case 'editCharacter':
        $characterController->editCharacter();
        break;

    case 'showCharacter':
        $id = $_GET['id'];
        $characterController->showCharacter($id);
        break;
}