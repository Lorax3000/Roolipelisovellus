<?php

class KampanjaModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createKampanja(
        $campaign_desc,
        $campaign_name,
        $campaign_status
    ) {
        $sql = "INSERT INTO campaigns
                (campaign_desc, campaign_name, campaign_status, gm_id)
                VALUES
                (:campaign_desc, :campaign_name, :campaign_status, :gm_id)";

        $stmt = $this->pdo->prepare($sql);

        $gm_id = $_SESSION['user_id'];

        $stmt->execute([
            ':campaign_desc' => $campaign_desc,
            ':campaign_name' => $campaign_name,
            ':campaign_status' => $campaign_status,
            ':gm_id' => $gm_id
        ]);
    }

    public function getKampanja($id)
    {
        $sql = "SELECT *
                FROM campaigns
                WHERE campaign_id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getKampanjas()
    {
        $sql = "SELECT *
                FROM campaigns
                WHERE campaign_id != 4
                ORDER BY created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function campaignNameExists($name)
    {
        $sql = "SELECT campaign_id
                FROM campaigns
                WHERE campaign_name = :name";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name
        ]);
    
        return $stmt->fetch() !== false;
    }

    public function editKampanja(
        $campaign_id,
        $campaign_desc,
        $campaign_name,
        $campaign_status
    ) {
        $sql = "UPDATE campaigns
                SET campaign_desc = :campaign_desc,
                    campaign_name = :campaign_name,
                    campaign_status = :campaign_status
                WHERE campaign_id = :campaign_id";

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
        $sql = "DELETE FROM campaign_notes
                WHERE note_campaign = :id";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    
        $sql = "DELETE FROM members
                WHERE member_campaign = :id";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    
        $sql = "DELETE FROM characters
                WHERE character_campaign = :id";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    
        $sql = "DELETE FROM campaigns
                WHERE campaign_id = :id";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    public function getUsers()
    {
        $sql = "SELECT user_id, username
                FROM users
                WHERE user_id != :user_id
                ORDER BY username";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $_SESSION['user_id']
        ]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPlayers($campaign_id)
    {
        $sql = "SELECT
                    m.member_id,
                    m.member_campaign,
                    m.member_user,
                    m.member_status,
                    u.username
                FROM members m
                INNER JOIN users u
                    ON u.user_id = m.member_user
                WHERE m.member_campaign = :campaign_id
                ORDER BY u.username";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':campaign_id' => $campaign_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPlayer($campaign_id, $user_id)
    {
        $sql = "SELECT gm_id
                FROM campaigns
                WHERE campaign_id = :campaign_id";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':campaign_id' => $campaign_id
        ]);
    
        $campaign = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$campaign) {
            return;
        }
    
        if ($campaign['gm_id'] == $user_id) {
            return;
        }
    
        $sql = "SELECT member_id
                FROM members
                WHERE member_campaign = :campaign_id
                AND member_user = :user_id";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':campaign_id' => $campaign_id,
            ':user_id' => $user_id
        ]);
    
        if ($stmt->fetch()) {
            return;
        }
    
        $sql = "INSERT INTO members
                (
                    member_campaign,
                    member_user,
                    member_status
                )
                VALUES
                (
                    :campaign_id,
                    :user_id,
                    'pending'
                )";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':campaign_id' => $campaign_id,
            ':user_id' => $user_id
        ]);
    }

    public function getCharactersByUser($user_id)
    {
        $sql = "SELECT character_id, character_name
                FROM characters
                WHERE character_user = :user_id
                ORDER BY character_name";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':user_id' => $user_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCharactersByCampaign($campaign_id)
    {
        $sql = "SELECT
                    c.character_id,
                    c.character_name,
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

    public function getAllCharacters()
    {
        $sql = "SELECT
                    c.character_id,
                    c.character_name,
                    c.character_user,
                    u.username
                FROM characters c
                INNER JOIN users u
                    ON u.user_id = c.character_user
                ORDER BY u.username, c.character_name";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCharacterToCampaign($character_id, $campaign_id)
    {
        $sql = "UPDATE characters
                SET character_campaign = :campaign_id
                WHERE character_id = :character_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':campaign_id' => $campaign_id,
            ':character_id' => $character_id
        ]);
    }

    public function updatePlayerStatus($member_id, $status)
    {
        $sql = "UPDATE members
                SET member_status = :status
                WHERE member_id = :member_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':status' => $status,
            ':member_id' => $member_id
        ]);
    }

    public function deletePlayer($member_id)
    {
        $sql = "DELETE FROM members
                WHERE member_id = :member_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':member_id' => $member_id
        ]);
    }

    public function getNotes($campaign_id)
    {
        $sql = "SELECT *
                FROM campaign_notes
                WHERE note_campaign = :campaign_id
                ORDER BY created_at DESC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':campaign_id' => $campaign_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNote($campaign_id, $content)
    {
        $sql = "INSERT INTO campaign_notes
                (
                    note_content,
                    note_campaign
                )
                VALUES
                (
                    :content,
                    :campaign_id
                )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':content' => $content,
            ':campaign_id' => $campaign_id
        ]);
    }

    public function updateNote($note_id, $content)
    {
        $sql = "UPDATE campaign_notes
                SET note_content = :content
                WHERE note_id = :note_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':content' => $content,
            ':note_id' => $note_id
        ]);
    }

    public function deleteNote($note_id)
    {
        $sql = "DELETE FROM campaign_notes
                WHERE note_id = :note_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':note_id' => $note_id
        ]);
    }

    public function getPendingInvitations($user_id)
    {
        $sql = "SELECT
                    m.member_id,
                    m.member_campaign,
                    c.campaign_name,
                    c.campaign_desc,
                    u.username AS gm_username
                FROM members m
                INNER JOIN campaigns c
                    ON c.campaign_id = m.member_campaign
                INNER JOIN users u
                    ON u.user_id = c.gm_id
                WHERE m.member_user = :user_id
                AND m.member_status = 'pending'
                ORDER BY c.created_at DESC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':user_id' => $user_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptInvitation($member_id, $user_id)
    {
        $sql = "UPDATE members
                SET member_status = 'alive'
                WHERE member_id = :member_id
                AND member_user = :user_id
                AND member_status = 'pending'";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':member_id' => $member_id,
            ':user_id' => $user_id
        ]);
    }

    public function archiveKampanja($campaign_id)
    {
        $sql = "UPDATE campaigns
                SET campaign_status = 'archived'
                WHERE campaign_id = :campaign_id";
    
        $stmt = $this->pdo->prepare($sql);
    
        $stmt->execute([
            ':campaign_id' => $campaign_id
        ]);
    }
}
?>