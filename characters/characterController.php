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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $name = $_POST['character_name'];
            $class = $_POST['character_class'];
            $race = $_POST['character_race'];

            $model = new CharacterModel($this->pdo);

            $model->editCharacter($id, $name, $class, $race);

            header("Location: ../index.php?page=dashboard");
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

    public function dashboard(){
        require 'pages/dashboard.php';
    }
}