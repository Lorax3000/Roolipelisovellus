<?php include "includes/header.php"; ?>

<body>

<main>

    <div class="back-button">
        <a href="index.php?page=kampanja">
            ← BACK TO CAMPAIGNS
        </a>
    </div>

    <div class="game-header">
        <h1>📨 INVITATIONS</h1>
    </div>

    <div class="kampanja-list">

        <?php if (empty($invitations)): ?>

            <p>No pending invitations.</p>

        <?php else: ?>

            <?php foreach ($invitations as $invitation): ?>

                <div class="kampanja">

                    <div class="kampanja-content">

                        <h2>
                            <?= htmlspecialchars($invitation['campaign_name']) ?>
                        </h2>

                        <p>
                            <?= htmlspecialchars($invitation['campaign_desc']) ?>
                        </p>

                        <p>
                            Invited by:
                            <strong>
                                <?= htmlspecialchars($invitation['gm_username']) ?>
                            </strong>
                        </p>

                    </div>

                    <div class="kampanja-buttons">

                        <form
                            method="POST"
                            action="index.php?page=acceptInvitation"
                        >

                            <input
                                type="hidden"
                                name="member_id"
                                value="<?= htmlspecialchars($invitation['member_id']) ?>"
                            >

                            <button type="submit">
                                ✅ ACCEPT
                            </button>

                        </form>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</main>

<?php include "includes/footer.php"; ?>