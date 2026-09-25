<?php include "includes/header.php"; ?>

<body>
    <div class="dashboard">

        <?php if (!isset($_SESSION['user_id'])): ?>

            <div class="dashboard-no-user">
                <h1>Welcome!</h1>

                <p>
                    Log in or create an account to manage your characters.
                </p>

                <div class="user-login-buttons">
                    <a href="index.php?page=login" class="user-login-button">
                        <button>Log In</button>
                    </a>

                    <a href="index.php?page=signup" class="user-login-button">
                        <button>Sign Up</button>
                    </a>
                </div>
            </div>

        <?php else: ?>

            <div class="dashboard-user">

                <div class="dashboard-header">
                    <h1>
                        Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!
                    </h1>

                    <a href="index.php?page=showCreateCharacter">
                        <button class="create-character-button">
                            + Create Character
                        </button>
                    </a>
                </div>

                <h2>Your Characters</h2>

                <?php if (empty($characters)): ?>

                    <p class="no-characters">
                        You don't have any characters yet.
                    </p>

                <?php else: ?>

                    <div class="character-list">

                        <?php foreach ($characters as $character): ?>

                            <div class="character">

                                <h3>
                                    <?= htmlspecialchars($character['character_name']) ?>
                                </h3>

                                <p>
                                    <strong>Class:</strong>
                                    <?= htmlspecialchars($character['character_class']) ?>
                                </p>

                                <p>
                                    <strong>Race:</strong>
                                    <?= htmlspecialchars($character['character_race']) ?>
                                </p>

                                <p>
                                    <strong>Level:</strong>
                                    <?= htmlspecialchars($character['character_level']) ?>
                                </p>

                                <a
                                    href="index.php?page=showCharacter&id=<?= $character['character_id'] ?>"
                                    class="view-character"
                                >
                                    View Character →
                                </a>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

                <a href="index.php?page=logout">
                    <button class="logout-button">Log Out</button>
                </a>

            </div>

        <?php endif; ?>

    </div>
</body>

<?php include "includes/footer.php"; ?>