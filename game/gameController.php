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

        if (!isset($_SESSION['enemy'])) {
            $_SESSION['enemy'] = [
                'name' => 'Goblin',
                'hp' => 50,
                'max_hp' => 50,
                'min_damage' => 3,
                'max_damage' => 10
            ];
        }

        if (!isset($_SESSION['battle_log'])) {
            $_SESSION['battle_log'] = [];
        }

        if (!isset($_SESSION['acted'])) {
            $_SESSION['acted'] = [];
        }

        if (!isset($_SESSION['defending'])) {
            $_SESSION['defending'] = [];
        }

        if (!isset($_SESSION['character_xp'])) {
            $_SESSION['character_xp'] = [];
        }

        foreach ($characters as $character) {
            if (!isset($_SESSION['character_xp'][$character['character_id']])) {
                $_SESSION['character_xp'][$character['character_id']] = 0;
            }
        }

        $enemy = $_SESSION['enemy'];

        require 'game.php';
    }

    public function attack($campaign_id)
    {
        $this->takeAction($campaign_id, 'attack');
    }

    public function defend($campaign_id)
    {
        $this->takeAction($campaign_id, 'defend');
    }

    private function takeAction($campaign_id, $action)
    {
        $model = new GameModel($this->pdo);

        $character_id = $_POST['character_id'] ?? null;

        if (!$character_id) {
            die('Character ID is missing.');
        }

        $characters = $model->getCharactersByCampaign($campaign_id);

        $actingCharacter = null;

        foreach ($characters as $character) {
            if ($character['character_id'] == $character_id) {
                $actingCharacter = $character;
                break;
            }
        }

        if (!$actingCharacter) {
            die('Character does not belong to this campaign.');
        }

        if ($actingCharacter['character_health'] <= 0) {
            die('Dead characters cannot act.');
        }

        if (in_array($character_id, $_SESSION['acted'])) {
            die('This character has already acted.');
        }

        if ($_SESSION['enemy']['hp'] <= 0) {
            header(
                'Location: index.php?page=game&campaign_id='
                . urlencode($campaign_id)
            );
            exit;
        }

        if ($action === 'attack') {

            $player_damage = rand(5, 15);

            $_SESSION['enemy']['hp'] -= $player_damage;

            if ($_SESSION['enemy']['hp'] < 0) {
                $_SESSION['enemy']['hp'] = 0;
            }

            $_SESSION['battle_log'][] =
                "⚔️ " .
                $actingCharacter['character_name'] .
                " attacked " .
                $_SESSION['enemy']['name'] .
                " for " .
                $player_damage .
                " damage!";
        }

        elseif ($action === 'defend') {

            $_SESSION['defending'][$character_id] = true;

            $_SESSION['battle_log'][] =
                "🛡️ " .
                $actingCharacter['character_name'] .
                " is defending!";
        }

        if ($_SESSION['enemy']['hp'] <= 0) {

            $xpRewards = [
                'Goblin' => 10,
                'Slime' => 8,
                'Orc' => 20
            ];

            $enemyName = $_SESSION['enemy']['name'];

            $xp = $xpRewards[$enemyName] ?? 10;

            if (!isset($_SESSION['character_xp'][$character_id])) {
                $_SESSION['character_xp'][$character_id] = 0;
            }

            $_SESSION['character_xp'][$character_id] += $xp;

            $_SESSION['battle_log'][] =
                "🏆 " .
                $enemyName .
                " was defeated!";

            $_SESSION['battle_log'][] =
                "✨ " .
                $actingCharacter['character_name'] .
                " gained " .
                $xp .
                " XP!";

            $currentLevel = (int) $actingCharacter['character_level'];

            $xpNeeded = ($currentLevel < 5) ? 10 : 25;

            while ($_SESSION['character_xp'][$character_id] >= $xpNeeded) {

                $_SESSION['character_xp'][$character_id] -= $xpNeeded;

                $currentLevel++;

                $model->levelUpCharacter(
                    $character_id,
                    $currentLevel - 1
                );

                $_SESSION['battle_log'][] =
                    "🎉 " .
                    $actingCharacter['character_name'] .
                    " leveled up to level " .
                    $currentLevel .
                    "!";

                if ($currentLevel <= 5) {
                    $_SESSION['battle_log'][] =
                        "📈 All stats increased by 5!";
                }
            
                $xpNeeded = ($currentLevel < 5) ? 10 : 25;
            }
        }

        else {

            $_SESSION['acted'][] = $character_id;

            $livingCharacters = [];

            foreach ($characters as $character) {

                if ($character['character_health'] > 0) {
                    $livingCharacters[] = $character;
                }
            }

            if (!empty($livingCharacters)) {

                $target =
                    $livingCharacters[array_rand($livingCharacters)];

                $enemy_damage = rand(
                    $_SESSION['enemy']['min_damage'],
                    $_SESSION['enemy']['max_damage']
                );

                $isDefending =
                    isset(
                        $_SESSION['defending'][$target['character_id']]
                    )
                    &&
                    $_SESSION['defending'][$target['character_id']]
                    === true;

                if ($isDefending) {

                    $enemy_damage = max(
                        1,
                        floor($enemy_damage / 2)
                    );

                    $_SESSION['battle_log'][] =
                        "🛡️ " .
                        $target['character_name'] .
                        " blocked part of the damage!";
                }

                $model->damageCharacter(
                    $target['character_id'],
                    $enemy_damage,
                    $campaign_id
                );

                $_SESSION['battle_log'][] =
                    "👹 " .
                    $_SESSION['enemy']['name'] .
                    " attacked " .
                    $target['character_name'] .
                    " for " .
                    $enemy_damage .
                    " damage!";

                if (
                    $target['character_health']
                    - $enemy_damage <= 0
                ) {

                    $_SESSION['battle_log'][] =
                        "💀 " .
                        $target['character_name'] .
                        " died!";
                }
            }
        }

        if (count($_SESSION['battle_log']) > 10) {

            $_SESSION['battle_log'] = array_slice(
                $_SESSION['battle_log'],
                -10
            );
        }

        $_SESSION['defending'] = [];

        $updatedCharacters =
            $model->getCharactersByCampaign($campaign_id);

        $livingCharacters = [];

        foreach ($updatedCharacters as $character) {

            if ($character['character_health'] > 0) {
                $livingCharacters[] = $character;
            }
        }

        if (empty($livingCharacters)) {

            $_SESSION['battle_log'][] =
                "💀 All players have been defeated!";
        }

        $allLivingActed = true;

        foreach ($livingCharacters as $character) {

            if (
                !in_array(
                    $character['character_id'],
                    $_SESSION['acted']
                )
            ) {

                $allLivingActed = false;
                break;
            }
        }

        if ($allLivingActed) {
            $_SESSION['acted'] = [];
        }

        header(
            'Location: index.php?page=game&campaign_id='
            . urlencode($campaign_id)
        );

        exit;
    }

    public function newBattle($campaign_id)
    {
        $enemies = [

            [
                'name' => 'Goblin',
                'hp' => 50,
                'max_hp' => 50,
                'min_damage' => 3,
                'max_damage' => 10
            ],

            [
                'name' => 'Slime',
                'hp' => 35,
                'max_hp' => 35,
                'min_damage' => 2,
                'max_damage' => 7
            ],

            [
                'name' => 'Orc',
                'hp' => 80,
                'max_hp' => 80,
                'min_damage' => 5,
                'max_damage' => 12
            ]
        ];

        $enemy = $enemies[array_rand($enemies)];

        $_SESSION['enemy'] = $enemy;

        $_SESSION['battle_log'] = [];

        $_SESSION['acted'] = [];

        $_SESSION['defending'] = [];

        header(
            'Location: index.php?page=game&campaign_id='
            . urlencode($campaign_id)
        );

        exit;
    }
}

?>