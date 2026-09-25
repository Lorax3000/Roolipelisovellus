<?php

class KampanjaModel{
private $pdo;

public function __construct($pdo){
    $this->pdo = $pdo;

}
 public function createKampanja($campaign_desc, $campaign_name, $campaign_status){
 $sql = "INSERT INTO campaigns (
    campaign_desc,
    campaign_name,
    campaign_status
 ) VALUES (
    :campaign_desc,
    :campaign_name,
    :campaign_status
 )";

$stmt = $this->pdo->prepare($sql);

$stmt->execute([

':campaign_desc' => $campaign_desc,
':campaign_name' => $campaign_name,
':campaign_status' => $campaign_status
]);

 }


 public function getKampanja($id){
    $sql = "SELECT * FROM campaigns WHERE campaign_id = :id";

     $stmt = $this->pdo->prepare($sql);

     $stmt->execute([

        ':id' => $id

     ]);

     return $stmt->fetch();
 }

 public function getKampanjas(){

    $sql = "SELECT * FROM campaigns";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
 }

 public function editKampanja( 
    $campaign_id, 
    $campaign_desc, 
    $campaign_name,
    $campaign_status)
 {

    $sql = "UPDATE campaigns SET
    campaign_desc = :campaign_desc,
    campaign_name = :campaign_name,
    campaign_status = :campaign_status
    WHERE campaign_id = :campaign_id
    ";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':campaign_desc' => $campaign_desc,
        ':campaign_name' => $campaign_name,
        ':campaign_status' => $campaign_status,
        ':campaign_id' => $campaign_id

    ]);
}

    public function deleteKampanja($id)
        {
        $sql = "DELETE FROM characters WHERE character_id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([':id' => $id]);
        }


}

?>