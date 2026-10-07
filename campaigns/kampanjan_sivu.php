<?php

$kampanja = $kampanja ?? [];
$users = $users ?? [];
$players = $players ?? [];
$characters = $characters ?? [];
$notes = $notes ?? [];
$user_characters = $user_characters ?? [];

include "includes/header.php";

?>

<title>
    <?= htmlspecialchars($kampanja['campaign_name'] ?? '') ?>
</title>

<body>

<main class="game-layout">

    <div class="back-button">
        <a href="index.php?page=kampanja">
            ← BACK TO CAMPAIGNS
        </a>
    </div>

    <section class="campaigns-section">

        <div class="section-title">
            <h2>
                <?= htmlspecialchars(
                    $kampanja['campaign_name'] ?? ''
                ) ?>
            </h2>
        </div>

        <div class="campaigns-content">

            <h3>Campaign description</h3>

            <p>
                <?= nl2br(
                    htmlspecialchars(
                        $kampanja['campaign_desc'] ?? ''
                    )
                ) ?>
            </p>

            <p>
                <strong>Status:</strong>
                <?= htmlspecialchars(
                    $kampanja['campaign_status'] ?? ''
                ) ?>
            </p>

        </div>

    </section>

    <section class="players-section">

        <div class="section-title">
            <h2>Players</h2>
        </div>

        <div class="players-header">
            <h3>Username</h3>
            <h3>Status</h3>
        </div>

        <div class="players-list">

            <?php if (empty($players)): ?>

                <p>No players yet.</p>

            <?php else: ?>

                <?php foreach ($players as $player): ?>

                    <div class="player-row">

                        <span class="player-name">
                            <?= htmlspecialchars(
                                $player['username']
                            ) ?>
                        </span>

                        <div class="player-actions">

                            <?php if ($player['member_status'] === 'pending'): ?>

                                <span class="player-status pending">
                                    PENDING
                                </span>

                            <?php else: ?>

                                <form
                                    method="POST"
                                    action="index.php?page=kampanja"
                                >

                                    <input
                                        type="hidden"
                                        name="action"
                                        value="updatePlayerStatus"
                                    >

                                    <input
                                        type="hidden"
                                        name="campaign_id"
                                        value="<?= htmlspecialchars(
                                            $kampanja['campaign_id']
                                        ) ?>"
                                    >

                                    <input
                                        type="hidden"
                                        name="member_id"
                                        value="<?= htmlspecialchars(
                                            $player['member_id']
                                        ) ?>"
                                    >

                                    <input
                                        type="hidden"
                                        name="status"
                                        value="<?= $player['member_status'] === 'alive'
                                            ? 'dead'
                                            : 'alive'
                                        ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="player-status <?= $player['member_status'] === 'alive'
                                            ? 'alive'
                                            : 'dead'
                                        ?>"
                                    >
                                        <?= strtoupper(
                                            htmlspecialchars(
                                                $player['member_status']
                                            )
                                        ) ?>
                                    </button>

                                </form>

                            <?php endif; ?>

                            <form
                                method="POST"
                                action="index.php?page=kampanja"
                                onsubmit="return confirm('Haluatko varmasti poistaa pelaajan?');"
                            >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="deletePlayer"
                                >

                                <input
                                    type="hidden"
                                    name="campaign_id"
                                    value="<?= htmlspecialchars(
                                        $kampanja['campaign_id']
                                    ) ?>"
                                >

                                <input
                                    type="hidden"
                                    name="member_id"
                                    value="<?= htmlspecialchars(
                                        $player['member_id']
                                    ) ?>"
                                >

                                <button
                                    type="submit"
                                    class="remove-player"
                                >
                                    ×
                                </button>

                            </form>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

        <div class="add-player-wrapper">

            <form
                method="POST"
                action="index.php?page=kampanja"
            >

                <input
                    type="hidden"
                    name="action"
                    value="addPlayer"
                >

                <input
                    type="hidden"
                    name="campaign_id"
                    value="<?= htmlspecialchars(
                        $kampanja['campaign_id']
                    ) ?>"
                >

                <select
                    name="user_id"
                    required
                >

                    <option value="">
                        -- SELECT PLAYER --
                    </option>

                    <?php foreach ($users as $user): ?>

                        <option
                            value="<?= htmlspecialchars(
                                $user['user_id']
                            ) ?>"
                        >
                            <?= htmlspecialchars(
                                $user['username']
                            ) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

                <button
                    type="submit"
                    class="add-player-btn"
                >
                    + ADD PLAYER
                </button>

            </form>

        </div>

        <div class="add-character-wrapper">

            <form
                method="POST"
                action="index.php?page=kampanja"
            >

                <input
                    type="hidden"
                    name="action"
                    value="addCharacter"
                >

                <input
                    type="hidden"
                    name="campaign_id"
                    value="<?= htmlspecialchars(
                        $kampanja['campaign_id']
                    ) ?>"
                >

                <select
                    name="character_id"
                    required
                >

                    <option value="">
                        -- SELECT CHARACTER --
                    </option>

                    <?php foreach ($user_characters as $character): ?>

                        <option
                            value="<?= htmlspecialchars(
                                $character['character_id']
                            ) ?>"
                        >
                            <?= htmlspecialchars(
                                $character['character_name']
                            ) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

                <button
                    type="submit"
                    class="add-player-btn"
                >
                    + ADD CHARACTER
                </button>

            </form>

        </div>

    </section>

    <section class="characters-section">

        <div class="section-title">
            <h2>Characters</h2>
        </div>

        <div class="characters-list">

            <?php if (empty($characters)): ?>

                <p>No characters yet.</p>

            <?php else: ?>

                <?php foreach ($characters as $character): ?>

                    <div class="character-row">

                        <span class="character-name">
                            <?= htmlspecialchars(
                                $character['character_name']
                            ) ?>
                        </span>

                        <span class="character-owner">
                            Player:
                            <?= htmlspecialchars(
                                $character['username']
                            ) ?>
                        </span>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </section>
                                
    <section class="start-section">
                                
        <?php if ($kampanja['campaign_status'] !== 'archived'): ?>
        
            <?php if (empty($characters)): ?>
            
                <p>To start you need to add at least 1 character.</p>
            
            <?php else: ?>
            
                <a
                    href="index.php?page=game&campaign_id=<?= htmlspecialchars(
                        $kampanja['campaign_id']
                    ) ?>"
                    class="start-game-btn"
                >
                    START GAME
                </a>
                    
            <?php endif; ?>
                    
        <?php else: ?>
        
            <p class="archived-message">
                📦 CAMPAIGN ARCHIVED
            </p>
        
        <?php endif; ?>
        
    </section>


    <section class="notes-section">

        <div class="section-title">
            <h2>Notes</h2>
        </div>

        <form
            method="POST"
            action="index.php?page=kampanja"
            class="note-form"
        >

            <input
                type="hidden"
                name="action"
                value="addNote"
            >

            <input
                type="hidden"
                name="campaign_id"
                value="<?= htmlspecialchars(
                    $kampanja['campaign_id']
                ) ?>"
            >

            <textarea
                name="note_content"
                placeholder="I love this game..."
                required
            ></textarea>

            <button type="submit">
                + ADD NOTE
            </button>

        </form>

        <div class="notes-list">

            <?php if (empty($notes)): ?>

                <p>No notes yet.</p>

            <?php else: ?>

                <?php foreach ($notes as $note): ?>

                    <div class="muistiinpano">

                        <h3>Notes</h3>

                        <p>
                            <?= nl2br(
                                htmlspecialchars(
                                    $note['note_content']
                                )
                            ) ?>
                        </p>

                        <small>
                            <?= htmlspecialchars(
                                $note['created_at'] ?? ''
                            ) ?>
                        </small>

                        <div class="note-buttons">

                            <form
                                method="POST"
                                action="index.php?page=kampanja"
                            >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="updateNote"
                                >

                                <input
                                    type="hidden"
                                    name="campaign_id"
                                    value="<?= htmlspecialchars(
                                        $kampanja['campaign_id']
                                    ) ?>"
                                >

                                <input
                                    type="hidden"
                                    name="note_id"
                                    value="<?= htmlspecialchars(
                                        $note['note_id']
                                    ) ?>"
                                >

                                <textarea
                                    name="note_content"
                                    required
                                ><?= htmlspecialchars(
                                    $note['note_content']
                                ) ?></textarea>

                                <button type="submit">
                                    Edit
                                </button>

                            </form>

                            <form
                                method="POST"
                                action="index.php?page=kampanja"
                                onsubmit="return confirm('Do you really want to delete this note?');"
                            >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="deleteNote"
                                >

                                <input
                                    type="hidden"
                                    name="campaign_id"
                                    value="<?= htmlspecialchars(
                                        $kampanja['campaign_id']
                                    ) ?>"
                                >

                                <input
                                    type="hidden"
                                    name="note_id"
                                    value="<?= htmlspecialchars(
                                        $note['note_id']
                                    ) ?>"
                                >

                                <button
                                    type="submit"
                                    class="remove-note"
                                >
                                    ×
                                </button>

                            </form>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </section>

    <?php if ($kampanja['gm_id'] == $_SESSION['user_id']): ?>

        <form
            method="POST"
            action="index.php?page=kampanja&action=archive"
        >

            <input
                type="hidden"
                name="campaign_id"
                value="<?= htmlspecialchars(
                    $kampanja['campaign_id']
                ) ?>"
            >

            <button type="submit" id='archive-button'>
                📦 ARCHIVE CAMPAIGN
            </button>

        </form>

    <?php endif; ?>

</main>

<?php include "includes/footer.php"; ?>