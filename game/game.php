<?php include "includes/header.php"; ?>

<body>

<main class="game">

    <h1>⚔️ BATTLE</h1>

    <section class="battle">

        <div class="characters">

            <h2>PLAYERS</h2>

            <?php if (empty($characters)): ?>

                <p>No characters are in this campaign.</p>

            <?php else: ?>

                <?php foreach ($characters as $character): ?>

                    <div class="character-card">

                        <h3>
                            <?= htmlspecialchars($character['character_name']) ?>
                        </h3>

                        <p>
                            ❤️ HP:
                            <?= htmlspecialchars($character['character_hp']) ?>
                            /
                            <?= htmlspecialchars($character['character_max_hp']) ?>
                        </p>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>


        <div class="vs">
            VS
        </div>


        <div class="enemy-card">

            <h2>👹 <?= htmlspecialchars($enemy['name']) ?></h2>

            <p>
                ❤️ HP:
                <?= htmlspecialchars($enemy['hp']) ?>
                /
                <?= htmlspecialchars($enemy['max_hp']) ?>
            </p>

        </div>

    </section>


    <button type="button">
        ⚔️ ATTACK
    </button>

</main>

<?php include "includes/footer.php"; ?>