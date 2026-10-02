<?php

require_once 'gameModel.php';

class GameController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function game($campaign_id)
    {
        $model = new GameModel($this->pdo);
    
        $characters = $model->getCharactersByCampaign($campaign_id);
        
        if (
            !isset($_SESSION['enemy']) ||
            $_SESSION['enemy']['hp'] <= 0
        ) {
            $_SESSION['enemy'] = [
                'name' => 'Goblin',
                'hp' => 50,
                'max_hp' => 50
            ];
        }
    
        $enemy = $_SESSION['enemy'];
    
        require 'game.php';
    }

    public function attack($campaign_id)
{
    $model = new GameModel($this->pdo);

    $player_damage = rand(5, 15);

    $_SESSION['enemy']['hp'] -= $player_damage;

    if ($_SESSION['enemy']['hp'] < 0) {
        $_SESSION['enemy']['hp'] = 0;
    }

    if ($_SESSION['enemy']['hp'] > 0) {

        $enemy_damage = rand(3, 10);

        $characters = $model->getCharactersByCampaign($campaign_id);

        if (!empty($characters)) {

            $character_id = $characters[0]['character_id'];

            $model->damageCharacter(
                $character_id,
                $enemy_damage,
                $campaign_id
            );
        }
    }

    header(
        'Location: index.php?page=game&campaign_id='
        . urlencode($campaign_id)
    );

    exit;
}
}
?>