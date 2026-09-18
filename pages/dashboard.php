<?php include "includes/header.php"; ?>

<body>

    <div class="dashboard">

        <?php if (!isset($_SESSION['user_id'])): ?>

            <h1>Welcome!</h1>

            <p>
                Log in or create an account to manage your characters.
            </p>

            <a href="index.php?page=login">
                <button>Log In</button>
            </a>

            <a href="index.php?page=signup">
                <button>Sign Up</button>
            </a>

        <?php else: ?>

            <h1>
                Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!
            </h1>

            <a href="index.php?page=showCreateCharacter">
                <button>Create Character</button>
            </a>

            <h2>Your Characters</h2>

            <?php if (empty($characters)): ?>

                <p>You don't have any characters yet.</p>

            <?php else: ?>

                <?php foreach ($characters as $character): ?>

                    <div class="character">

                        <h3>
                            <?= htmlspecialchars($character['character_name']) ?>
                        </h3>

                        <p>
                            Class:
                            <?= htmlspecialchars($character['character_class']) ?>
                        </p>

                        <p>
                            Race:
                            <?= htmlspecialchars($character['character_race']) ?>
                        </p>

                        <p>
                            Level:
                            <?= htmlspecialchars($character['character_level']) ?>
                        </p>

                        <a href="index.php?page=showCharacter&id=<?= $character['character_id'] ?>">
                            View Character
                        </a>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

            <br>

            <a href="index.php?page=logout">
                <button>Log Out</button>
            </a>

        <?php endif; ?>

    </div>

</body>

<?php include "includes/footer.php"; ?>