<?php

require_once 'characterModel.php';

class CharacterController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showCreateCharacter()
    {
        require 'create.php';
    }

    public function createCharacter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['character_name'];
            $class = $_POST['character_class'];
            $race = $_POST['character_race'];

            $model = new CharacterModel($this->pdo);

            $model->createCharacter($name, $class, $race);

            header("Location: index.php?page=dashboard");
            exit();
        }
    }

    public function showEditCharacter($id)
    {
        $model = new CharacterModel($this->pdo);

        $character = $model->getCharacter($id);

        require 'edit.php';
    }

    public function editCharacter()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?page=login");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = $_POST['id'];
        $name = $_POST['character_name'];
        $class = $_POST['character_class'];
        $race = $_POST['character_race'];
        $notes = $_POST['character_notes'];
        $status = $_POST['character_status'];

        $userId = $_SESSION['user_id'];

        $model = new CharacterModel($this->pdo);

        $model->editCharacter($id, $userId, $name, $class, $race, $notes, $status);

        header("Location: index.php?page=dashboard");
        exit();
    }
}

    public function showCharacter($id)
    {
        $model = new CharacterModel($this->pdo);

        $character = $model->getCharacter($id);

        require 'details.php';
    }

    public function deleteCharacter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];

            $model = new CharacterModel($this->pdo);

            $model->deleteCharacter($id);

            header("Location: index.php?page=dashboard");
            exit();
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['user_id'])) {
    
            $userId = $_SESSION['user_id'];
    
            $model = new CharacterModel($this->pdo);
    
            $characters = $model->getCharactersByUser($userId);
        } else {
            $characters = [];
        }
    
        require 'pages/dashboard.php';
    }
}