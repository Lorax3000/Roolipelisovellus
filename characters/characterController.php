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
            $health = $_POST['character_health'];
            $notes = $_POST['character_notes'];
            $status = $_POST['character_status'];
            $character_max_hp = $_POST['character_max_hp'];
    
            $model = new CharacterModel($this->pdo);
    
            $character = $model->getCharacter($id);
    
            if (!$character) {
                die('Character not found.');
            }
    
            $userId = $_SESSION['user_id'];
    
            $allowed = $character['character_user'] == $userId;
    
            if (!$allowed && $character['character_campaign'] != 4) {
    
                $sql = "SELECT gm_id
                        FROM campaigns
                        WHERE campaign_id = :campaign_id";
    
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':campaign_id' => $character['character_campaign']
                ]);
    
                $campaign = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if ($campaign && $campaign['gm_id'] == $userId) {
                    $allowed = true;
                }
            }
    
            if (!$allowed) {
                die('You are not authorized to edit this character.');
            }
    
            $model->editCharacter(
                $id,
                $health,
                $notes,
                $status,
                $character_max_hp
            );
    
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
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $id = $_POST['id'];
            $userId = $_SESSION['user_id'];
    
            $model = new CharacterModel($this->pdo);
    
            $character = $model->getCharacter($id);
    
            if (!$character) {
                die('Character not found.');
            }
    
            if ($character['character_user'] != $userId) {
                die('You can only delete your own characters.');
            }
    
            if ($character['character_status'] !== 'dead') {
                die('Only dead chaacters can be deleted.');
            }
    
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