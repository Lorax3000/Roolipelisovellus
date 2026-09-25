<?php

class CharacterModel{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function createCharacter($name, $class, $race){
        $sql = "INSERT INTO characters (
            character_user,
            character_campaign,
            character_name,
            character_class,
            character_race,
            character_level,
            character_health,
            character_mana,
            character_strength,
            character_endurance,
            character_agility,
            character_intelligence,
            character_charisma,
            character_notes,
            character_status
        ) VALUES (
            :user,
            :campaign,
            :name,
            :class,
            :race,
            :level,
            :health,
            :mana,
            :strength,
            :endurance,
            :agility,
            :intelligence,
            :charisma,
            :notes,
            :status
        )";
        
        $stmt = $this->pdo->prepare($sql);
        
        $user = $_SESSION['user_id'];
        $campaign = 1;
        $level = 1;

        $health = rand(10, 100);
        $mana = rand(10, 100);
        $strength = rand(1, 20);
        $endurance = rand(1, 20);
        $agility = rand(1, 20);
        $intelligence = rand(1, 20);
        $charisma = rand(1, 20);
        
        $notes = "";
        $status = "alive";
        
        
        $stmt->execute([
            ':user' => $user,
            ':campaign' => $campaign,
            ':name' => $name,
            ':class' => $class,
            ':race' => $race,
            ':level' => $level,
            ':health' => $health,
            ':mana' => $mana,
            ':strength' => $strength,
            ':endurance' => $endurance,
            ':agility' => $agility,
            ':intelligence' => $intelligence,
            ':charisma' => $charisma,
            ':notes' => $notes,
            ':status' => $status
        ]);
    }

    public function getCharacter($id){
        $sql = "SELECT * FROM characters WHERE character_id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCharactersByUser($userId)
    {
        $sql = "SELECT * FROM characters
                WHERE character_user = :user";
    
        $stmt = $this->pdo->prepare($sql);
    
        $stmt->execute([
            ':user' => $userId
        ]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editCharacter(
        $id,
        $userId,
        $name,
        $class,
        $race,
        $notes,
        $status
    ) {
        $sql = "UPDATE characters SET
            character_name = :name,
            character_class = :class,
            character_race = :race,
            character_notes = :notes,
            character_status = :status
            WHERE character_id = :id
            AND character_user = :user";
    
        $stmt = $this->pdo->prepare($sql);
    
        $stmt->execute([
            ':id' => $id,
            ':user' => $userId,
            ':name' => $name,
            ':class' => $class,
            ':race' => $race,
            ':notes' => $notes,
            ':status' => $status
        ]);
    }

    public function deleteCharacter($id){
        $sql = "DELETE FROM characters WHERE character_id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([':id' => $id]);
    }
}