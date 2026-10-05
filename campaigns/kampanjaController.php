<?php

require_once 'kampanjaModel.php';

class KampanjaController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    private function checkOwner($campaign_id){
        $model = new KampanjaModel($this->pdo);
        $kampanja = $model->getKampanja($campaign_id);

        if (!$kampanja){
            die(`We didn't find that one.`);
        }

        if ($_SESSION['user_id'] == 13){
            return $kampanja;
        }

        if (!isset($_SESSION['user_id']) || $kampanja['gm_id'] != $_SESSION['user_id']){
            die('Maybe try contacting the actual gm');
        }
    }


    public function campaigns()
    {
        $model = new KampanjaModel($this->pdo);

        $kampanjat = $model->getKampanjas();

        require 'kampanja.php';
    }


    public function createForm()
    {
        $model = new KampanjaModel($this->pdo);

        $kampanja = $model->getKampanjas();

        require 'kampanja.php';
    }

    public function createKampanja()
    {
        $campaign_name = trim(
            $_POST['campaign_name'] ?? ''
        );

        $campaign_desc = trim(
            $_POST['campaign_desc'] ?? ''
        );

        $campaign_status = trim(
            $_POST['campaign_status'] ?? 'active'
        );


        if ($campaign_name === '') {
            die('Anna kampanjalle nimi.');
        }


        $model = new KampanjaModel($this->pdo);

        $model->createKampanja(
            $campaign_desc,
            $campaign_name,
            $campaign_status
        );


        header(
            'Location: index.php?page=kampanja'
        );

        exit;
    }

    public function editForm($id)
    {
        $model = new KampanjaModel($this->pdo);
        $kampanja = $model->getKampanja($id);
    
        if (!$kampanja) {
            die('Campaign not found');
        }
    
        if ($kampanja['gm_id'] != $_SESSION['user_id']) {
            die('You are not authorized to change this.');
        }
    
        $kampanjat = $model->getKampanjas();
    
        require 'kampanja.php';
    }

    public function updateKampanja()
    {
        $campaign_id = $_POST['campaign_id'] ?? null;

        $campaign_name = trim(
            $_POST['campaign_name'] ?? ''
        );

        $campaign_desc = trim(
            $_POST['campaign_desc'] ?? ''
        );

        $campaign_status = trim(
            $_POST['campaign_status'] ?? 'active'
        );


        if (!$campaign_id) {
            die('Kampanjan ID puuttuu.');
        }

        if ($campaign_name === '') {
            die('Anna kampanjalle nimi.');
        }

        $model = new KampanjaModel($this->pdo);

        $model->editKampanja(
            $campaign_id,
            $campaign_desc,
            $campaign_name,
            $campaign_status
        );

        header(
            'Location: index.php?page=kampanja'
        );

        exit;
    }

    public function deleteKampanja()
    {
        $campaign_id = $_POST['campaign_id'] ?? null;


        if (!$campaign_id) {
            die('Kampanjan ID puuttuu.');
        }

        $this->checkOwner($campaign_id);

        $model = new KampanjaModel($this->pdo);

        $model->deleteKampanja($campaign_id);


        header(
            'Location: index.php?page=kampanja'
        );

        exit;
    }

    public function showKampanja($id)
    {
        $model = new KampanjaModel($this->pdo);
    
        $kampanja = $model->getKampanja($id);
    
        if (!$kampanja) {
            die('Kampanjaa ei löytynyt.');
        }
    
        $players = $model->getPlayers($id);
        $characters = $model->getCharactersByCampaign($id);
        $notes = $model->getNotes($id);
        $users = $model->getUsers();
    
        $user_characters = [];
    
        if (isset($_SESSION['user_id'])) {
            $user_characters = $model->getCharactersByUser(
                $_SESSION['user_id']
            );
        }
    
        require 'kampanjan_sivu.php';
    }

    public function addCharacter()
    {
        $campaign_id = $_POST['campaign_id'] ?? null;
        $character_id = $_POST['character_id'] ?? null;
    
        if (!$campaign_id || !$character_id) {
            die('Hahmon tiedot puuttuvat.');
        }
    
        $model = new KampanjaModel($this->pdo);
    
        $model->addCharacterToCampaign(
            $character_id,
            $campaign_id
        );
    
        header(
            'Location: index.php?page=kampanja&action=show&id='
            . urlencode($campaign_id)
        );
    
        exit;
    }

    public function addPlayer()
    {
        $campaign_id = $_POST['campaign_id'] ?? null;

        $user_id = $_POST['user_id'] ?? null;


        if (!$campaign_id || !$user_id) {
            die('Pelaajan tiedot puuttuvat.');
        }

        $this->checkOwner($campaign_id);

        $model = new KampanjaModel($this->pdo);

        $model->addPlayer(
            $campaign_id,
            $user_id
        );

        header(
            'Location: index.php?page=kampanja&action=show&id='
            . urlencode($campaign_id)
        );

        exit;
    }

    public function updatePlayerStatus()
    {
        $campaign_id = $_POST['campaign_id'] ?? null;

        $member_id = $_POST['member_id'] ?? null;

        $status = $_POST['status'] ?? 'alive';

        if (!$campaign_id || !$member_id) {
            die('Pelaajan tiedot puuttuvat.');
        }

        if (!in_array($status, ['alive', 'dead'])) {
            $status = 'alive';
        }

        $this->checkOwner($campaign_id);

        $model = new KampanjaModel($this->pdo);

        $model->updatePlayerStatus(
            $member_id,
            $status
        );

        header(
            'Location: index.php?page=kampanja&action=show&id='
            . urlencode($campaign_id)
        );

        exit;
    }


    public function deletePlayer()
    {
        $campaign_id = $_POST['campaign_id'] ?? null;

        $member_id = $_POST['member_id'] ?? null;

        if (!$campaign_id || !$member_id) {
            die('Pelaajan tiedot puuttuvat.');
        }

        $this->checkOwner($campaign_id);

        $model = new KampanjaModel($this->pdo);

        $model->deletePlayer($member_id);


        header(
            'Location: index.php?page=kampanja&action=show&id='
            . urlencode($campaign_id)
        );

        exit;
    }

    public function addNote()
    {
        $campaign_id = $_POST['campaign_id'] ?? null;

        $content = trim(
            $_POST['note_content'] ?? ''
        );

        if (!$campaign_id) {
            die('Kampanjan ID puuttuu.');
        }

        if ($content === '') {
            die('Muistiinpano ei voi olla tyhjä.');
        }

        $this->checkOwner($campaign_id);

        $model = new KampanjaModel($this->pdo);

        $model->addNote(
            $campaign_id,
            $content
        );

        header(
            'Location: index.php?page=kampanja&action=show&id='
            . urlencode($campaign_id)
        );

        exit;
    }


    public function updateNote()
    {
        $campaign_id = $_POST['campaign_id'] ?? null;

        $note_id = $_POST['note_id'] ?? null;

        $content = trim(
            $_POST['note_content'] ?? ''
        );


        if (!$campaign_id || !$note_id) {
            die('Muistiinpanon tiedot puuttuvat.');
        }


        if ($content === '') {
            die('Muistiinpano ei voi olla tyhjä.');
        }

        $this->checkOwner($campaign_id);

        $model = new KampanjaModel($this->pdo);

        $model->updateNote(
            $note_id,
            $content
        );

        header(
            'Location: index.php?page=kampanja&action=show&id='
            . urlencode($campaign_id)
        );

        exit;
    }

    public function deleteNote()
    {
        $campaign_id = $_POST['campaign_id'] ?? null;

        $note_id = $_POST['note_id'] ?? null;

        if (!$campaign_id || !$note_id) {
            die('Muistiinpanon tiedot puuttuvat.');
        }

        $this->checkOwner($campaign_id);

        $model = new KampanjaModel($this->pdo);

        $model->deleteNote(
            $note_id
        );

        header(
            'Location: index.php?page=kampanja&action=show&id='
            . urlencode($campaign_id)
        );

        exit;
    }
}

?>