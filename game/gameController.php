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

        $enemy = [
            'name' => 'Goblin',
            'hp' => 15,
            'max_hp' => 15
        ];

        require 'game/game.php';
    }
}
?>