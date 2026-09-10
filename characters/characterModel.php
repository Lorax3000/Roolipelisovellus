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
        
        $user = 1;
        $campaign = 1;
        $level = 1;
        $health = 1;
        $mana = 1;
        $strength = 1;
        $endurance = 1;
        $agility = 1;
        $intelligence = 1;
        $charisma = 1;
        $notes = "Yeah";
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

    public function editCharacter($id, $name, $class, $race)
{
    $sql = "UPDATE characters SET
        character_name = :name,
        character_class = :class,
        character_race = :race,
        character_level = :level,
        character_health = :health,
        character_mana = :mana,
        character_strength = :strength,
        character_endurance = :endurance,
        character_agility = :agility,
        character_intelligence = :intelligence,
        character_charisma = :charisma,
        character_notes = :notes,
        character_status = :status
        WHERE character_id = :id";

    $stmt = $this->pdo->prepare($sql);

    $level = 1;
    $health = 1;
    $mana = 1;
    $strength = 1;
    $endurance = 1;
    $agility = 1;
    $intelligence = 1;
    $charisma = 1;
    $notes = "Yeah";
    $status = "alive";

    $stmt->execute([
        ':id' => $id,
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

    public function deleteCharacter($id){
        $sql = "DELETE FROM characters WHERE character_id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([':id' => $id]);
    }
}