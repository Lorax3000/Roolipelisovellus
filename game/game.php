<?php include "includes/header.php"; ?>

<body>

<main class="game">

    <div class="game-header">
        <h1>⚔️ BATTLE</h1>
    </div>

    <div class="back-button">
        <a href="index.php?page=kampanja&action=show&id=<?= htmlspecialchars($campaign_id) ?>">
            ← BACK TO CAMPAIGN
        </a>
    </div>

    <section class="battle">

        <div class="characters-section">

            <h2>PLAYERS</h2>

            <?php if (empty($characters)): ?>

                <p class="no-characters">
                    No characters are in this campaign.
                </p>

            <?php else: ?>

                <div class="character-grid">

                    <?php foreach ($characters as $character): ?>

                        <div class="character-card">

                            <h3>
                                <?= htmlspecialchars(
                                    $character['character_name']
                                ) ?>
                            </h3>

                            <p>
                                👤
                                <?= htmlspecialchars(
                                    $character['username']
                                ) ?>
                            </p>

                            <p>
                                ❤️ HP:
                                <?= htmlspecialchars(
                                    $character['character_health']
                                ) ?>
                                /
                                <?= htmlspecialchars(
                                    $character['character_max_hp']
                                ) ?>
                            </p>

                            <p>
                                ⭐ XP:
                                <?= $_SESSION['character_xp'][$character['character_id']] ?? 0 ?>
                                /
                                <?= $character['character_level'] <= 5 ? 10 : 25 ?>
                            </p>

                            <p>
                                🆙 Level:
                                <?= htmlspecialchars(
                                    $character['character_level']
                                ) ?>
                            </p>

                            <?php if ($character['character_health'] > 0): ?>

                                <?php if (
                                    !in_array(
                                        $character['character_id'],
                                        $_SESSION['acted'] ?? []
                                    )
                                ): ?>

                                    <div class="actions">

                                        <form
                                            method="POST"
                                            action="index.php?page=attack"
                                        >

                                            <input
                                                type="hidden"
                                                name="campaign_id"
                                                value="<?= htmlspecialchars($campaign_id) ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="character_id"
                                                value="<?= htmlspecialchars($character['character_id']) ?>"
                                            >

                                            <button
                                                type="submit"
                                                class="attack-button"
                                            >
                                                ⚔️ ATTACK
                                            </button>

                                        </form>

                                        <form
                                            method="POST"
                                            action="index.php?page=defend"
                                        >

                                            <input
                                                type="hidden"
                                                name="campaign_id"
                                                value="<?= htmlspecialchars($campaign_id) ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="character_id"
                                                value="<?= htmlspecialchars($character['character_id']) ?>"
                                            >

                                            <button
                                                type="submit"
                                                class="defend-button"
                                            >
                                                🛡️ DEFEND
                                            </button>

                                        </form>

                                    </div>

                                <?php else: ?>

                                    <p class="acted">
                                        ✅ ACTED
                                    </p>

                                <?php endif; ?>

                            <?php else: ?>

                                <p class="dead">
                                    💀 DEAD
                                </p>

                            <?php endif; ?>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

        <div class="vs">
            VS
        </div>

        <div class="enemy-section">

            <div class="enemy-card">

                <h2>
                    👹
                    <?= htmlspecialchars($enemy['name']) ?>
                </h2>

                <div class="enemy-hp">
                    ❤️
                    <?= htmlspecialchars($enemy['hp']) ?>
                    /
                    <?= htmlspecialchars($enemy['max_hp']) ?>
                </div>

                <div class="hp-bar">
                    <div
                        class="hp-bar-fill"
                        style="width: <?= $enemy['max_hp'] > 0
                            ? ($enemy['hp'] / $enemy['max_hp']) * 100
                            : 0 ?>%;"
                    ></div>
                </div>

            </div>

            <?php if ($enemy['hp'] <= 0): ?>

                <div class="defeated">

                    <h3>🏆 DEFEATED</h3>

                    <form
                        method="POST"
                        action="index.php?page=newBattle"
                    >

                        <input
                            type="hidden"
                            name="campaign_id"
                            value="<?= htmlspecialchars($campaign_id) ?>"
                        >

                        <button
                            type="submit"
                            class="new-battle-button"
                        >
                            ⚔️ NEW BATTLE
                        </button>

                    </form>

                </div>

            <?php endif; ?>

        </div>

    </section>

    <section class="battle-log">

        <h2>📜 BATTLE LOG</h2>

        <?php if (empty($_SESSION['battle_log'])): ?>

            <p>No actions yet.</p>

        <?php else: ?>

            <?php foreach ($_SESSION['battle_log'] as $message): ?>

                <p>
                    <?= htmlspecialchars($message) ?>
                </p>

            <?php endforeach; ?>

        <?php endif; ?>

    </section>

</main>

<?php include "includes/footer.php"; ?>