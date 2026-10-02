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

    public function attackEnemy($damage)
    {
        $enemy_hp = 50;

        $enemy_hp -= $damage;

        if ($enemy_hp < 0) {
            $enemy_hp = 0;
        }

        return $enemy_hp;
    }

    public function damageCharacter($character_id, $damage, $campaign_id)
    {
        $sql = "UPDATE characters
                SET character_health = GREATEST(character_health - :damage, 0)
                WHERE character_id = :character_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':damage' => $damage,
            ':character_id' => $character_id
        ]);


        $sql = "SELECT character_health
                FROM characters
                WHERE character_id = :character_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':character_id' => $character_id
        ]);

        $character = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($character && $character['character_health'] <= 0) {

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
}
?>