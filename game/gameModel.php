<?php

class GameModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCharactersByCampaign($campaign_id)
    {
        $sql = "SELECT
                    c.character_id,
                    c.character_name,
                    c.character_health,
                    c.character_max_hp,
                    c.character_level,
                    c.character_user,
                    u.username
                FROM characters c
                INNER JOIN users u
                    ON u.user_id = c.character_user
                WHERE c.character_campaign = :campaign_id
                ORDER BY c.character_name";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':campaign_id' => $campaign_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function damageCharacter($character_id, $damage, $campaign_id)
    {
        $sql = "SELECT character_health
                FROM characters
                WHERE character_id = :character_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':character_id' => $character_id
        ]);

        $character = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$character) {
            return;
        }

        $current_health = (int) $character['character_health'];

        $new_health = $current_health - $damage;

        if ($new_health < 0) {
            $new_health = 0;
        }

        $sql = "UPDATE characters
                SET character_health = :health
                WHERE character_id = :character_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':health' => $new_health,
            ':character_id' => $character_id
        ]);

        if ($new_health <= 0) {

            $sql = "UPDATE members
                    SET member_status = 'dead'
                    WHERE member_character = :character_id
                    AND member_campaign = :campaign_id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':character_id' => $character_id,
                ':campaign_id' => $campaign_id
            ]);
        }
    }
    
    public function levelUpCharacter($character_id, $currentLevel)
    {
        $newLevel = $currentLevel + 1;

        if ($newLevel <= 5) {

            $sql = "UPDATE characters
                    SET
                        character_level = :level,
                        character_strength = character_strength + 5,
                        character_endurance = character_endurance + 5,
                        character_agility = character_agility + 5,
                        character_intelligence = character_intelligence + 5,
                        character_charisma = character_charisma + 5,
                        character_max_hp = character_max_hp + 5,
                        character_health = character_max_hp + 5
                    WHERE character_id = :character_id";

        } else {

            $sql = "UPDATE characters
                    SET character_level = :level
                    WHERE character_id = :character_id";
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':level' => $newLevel,
            ':character_id' => $character_id
        ]);
    }
}
?>