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

            $name = trim($_POST['character_name'] ?? '');
            $class = $_POST['character_class'];
            $race = $_POST['character_race'];

            $name = preg_replace('/[^\p{L}\p{N}\s\'-]/u', '', $name);

            $name = preg_replace('/\s+/', ' ', $name);

            if (strlen($name) < 4 || strlen($name) > 12){
                die("Name may be between 4 and 12 characters long. (Special characters do not count as they are deleted)");
            }

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
            $level = $_POST['character_level'];
            $mana = $_POST['character_mana'];
            $strength = $_POST['character_strength'];
            $endurance = $_POST['character_endurance'];
            $agility = $_POST['character_agility'];
            $intelligence = $_POST['character_intelligence'];
            $charisma = $_POST['character_charisma'];
            $notes = $_POST['character_notes'];
            $status = $_POST['character_status'];
            $character_max_hp = $_POST['character_max_hp'];
    
            $model = new CharacterModel($this->pdo);
    
            $character = $model->getCharacter($id);
    
            if (!$character) {
                die('Character not found.');
            }

            if ($health > $character_max_hp) {
                die("Health cannot be higher than max.");
            }

            if ($health > 9999 || $character_max_hp > 9999 || $level > 9999 || $mana > 9999 || $strength > 9999 || $endurance > 9999 || $agility > 9999 || $intelligence > 9999 || $charisma > 9999){
                die("Values may not exceed 9999");
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
                $level,
                $mana,
                $strength,
                $endurance,
                $agility,
                $intelligence,
                $charisma,
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