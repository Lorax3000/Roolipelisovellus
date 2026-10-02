<?php include "includes/header.php"; ?>

<main>


    <div class="campaign-header">

        <h2>CAMPAIGNS</h2>

        <a href="index.php?page=dashboard">
            Dashboard
        </a>

        <a
            href="index.php?page=kampanja&action=create"
            class="create-button"
        >
            + CREATE CAMPAIGN
        </a>

    </div>


    <?php if (isset($kampanja)): ?>

        <section class="kampanja-form">

            <?php if (!empty($kampanja['campaign_id'])): ?>

                <h2>Edit campaign</h2>

                <form
                    method="POST"
                    action="../index.php?page=kampanja"
                >

                    <input
                        type="hidden"
                        name="action"
                        value="update"
                    >

                    <input
                        type="hidden"
                        name="campaign_id"
                        value="<?= htmlspecialchars($kampanja['campaign_id']) ?>"
                    >

            <?php else: ?>

                <h2>Create new campaign</h2>

                <form
                    method="POST"
                    action="../index.php?page=kampanja"
                >

                    <input
                        type="hidden"
                        name="action"
                        value="create"
                    >

            <?php endif; ?>


                <div class="form-group">

                    <label for="campaign_name">
                        Campaign name
                    </label>

                    <input
                        type="text"
                        id="campaign_name"
                        name="campaign_name"
                        value="<?= htmlspecialchars($kampanja['campaign_name'] ?? '') ?>"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="campaign_desc">
                        Campaign description
                    </label>

                    <textarea
                        id="campaign_desc"
                        name="campaign_desc"
                        rows="5"
                    ><?= htmlspecialchars($kampanja['campaign_desc'] ?? '') ?></textarea>

                </div>

                <div class="form-group">

                    <label for="campaign_status">
                        Status
                    </label>

                    <select
                        id="campaign_status"
                        name="campaign_status"
                    >

                        <option
                            value="active"
                            <?= (($kampanja['campaign_status'] ?? 'active') === 'active') ? 'selected' : '' ?>
                        >
                            Active
                        </option>

                        <option
                            value="paused"
                            <?= (($kampanja['campaign_status'] ?? '') === 'paused') ? 'selected' : '' ?>
                        >
                            Paused
                        </option>

                        <option
                            value="finished"
                            <?= (($kampanja['campaign_status'] ?? '') === 'finished') ? 'selected' : '' ?>
                        >
                            Finished
                        </option>

                    </select>

                </div>

                <div class="form-buttons">

                    <button type="submit">

                        <?php if (!empty($kampanja['campaign_id'])): ?>

                            Save changes

                        <?php else: ?>

                            Create

                        <?php endif; ?>

                    </button>


                    <a href="../index.php?page=kampanja">
                        Cancel
                    </a>

                </div>


            </form>

        </section>

    <?php endif; ?>


    <section class="kampanja-list">

        <?php if (empty($kampanjat)): ?>

            <p>No campaigns yet.</p>

        <?php else: ?>


            <?php foreach ($kampanjat as $kampanjaItem): ?>

                <div class="kampanja">

                    <div class="kampanja-content">

                        <h2>
                            <?= htmlspecialchars(
                                $kampanjaItem['campaign_name']
                            ) ?>
                        </h2>


                        <p>
                            <?= nl2br(
                                htmlspecialchars(
                                    $kampanjaItem['campaign_desc'] ?? ''
                                )
                            ) ?>
                        </p>


                        <p>

                            <strong>Status:</strong>

                            <?= htmlspecialchars(
                                $kampanjaItem['campaign_status']
                            ) ?>

                        </p>

                    </div>

                    <div class="kampanja-buttons">


                        <a
                            href="../index.php?page=kampanja&action=show&id=<?= htmlspecialchars($kampanjaItem['campaign_id']) ?>"
                        >
                            Open
                        </a>


                        <a
                            href="../index.php?page=kampanja&action=edit&id=<?= htmlspecialchars($kampanjaItem['campaign_id']) ?>"
                        >
                            Edit
                        </a>


                        <form
                            method="POST"
                            action="../index.php?page=kampanja"
                            onsubmit="return confirm('Haluatko varmasti poistaa tämän kampanjan?');"
                        >

                            <input
                                type="hidden"
                                name="action"
                                value="delete"
                            >

                            <input
                                type="hidden"
                                name="campaign_id"
                                value="<?= htmlspecialchars($kampanjaItem['campaign_id']) ?>"
                            >

                            <button type="submit">
                                Delete
                            </button>

                        </form>


                    </div>

                </div>

            <?php endforeach; ?>


        <?php endif; ?>

    </section>

<?php include "includes/footer.php"; ?>