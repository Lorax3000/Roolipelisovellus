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
        $sql = "SELECT *
                FROM characters
                WHERE character_campaign = :campaign_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':campaign_id' => $campaign_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>