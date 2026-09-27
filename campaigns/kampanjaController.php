<?php

require_once 'kampanjaModel.php';


class KampanjaController
{
    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function index()
    {
        $model = new KampanjaModel($this->pdo);

        $kampanjat = $model->getKampanjas();

        require 'kampanja.php';
    }


    public function createForm()
    {
        $model = new KampanjaModel($this->pdo);

        $kampanjat = $model->getKampanjas();

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
            die('Kampanjaa ei löytynyt.');
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


        $model = new KampanjaModel($this->pdo);


        $model->deleteKampanja(
            $campaign_id
        );


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


        require 'kampanjan_sivu.php';
    }
}

?>