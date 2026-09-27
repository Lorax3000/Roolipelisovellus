<!DOCTYPE html>
<html lang="fi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kampanjat</title>

    <link rel="stylesheet" href="style_kampanja.css">
</head>

<body>

<header>
    <h1>WEB</h1>
</header>


<main>


    <div class="campaign-header">

        <h2>KAMPANJAT</h2>

        <a
            href="../index.php?page=kampanja&action=create"
            class="create-button"
        >
            + LUO KAMPANJA
        </a>

    </div>


    <?php if (isset($kampanja)): ?>

        <section class="kampanja-form">

            <?php if (!empty($kampanja['campaign_id'])): ?>

                <h2>MUOKKAA KAMPANJAA</h2>

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

                <h2>LUO UUSI KAMPANJA</h2>

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
                        Kampanjan nimi
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
                        Kampanjan kuvaus
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

                            TALLENNA MUUTOKSET

                        <?php else: ?>

                            LUO KAMPANJA

                        <?php endif; ?>

                    </button>


                    <a href="../index.php?page=kampanja">
                        PERUUTA
                    </a>

                </div>


            </form>

        </section>

    <?php endif; ?>


    <section class="kampanja-list">

        <?php if (empty($kampanjat)): ?>

            <p>Ei kampanjoita vielä.</p>

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
                            AVAA
                        </a>


                        <a
                            href="../index.php?page=kampanja&action=edit&id=<?= htmlspecialchars($kampanjaItem['campaign_id']) ?>"
                        >
                            MUOKKAA
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
                                POISTA
                            </button>

                        </form>


                    </div>

                </div>

            <?php endforeach; ?>


        <?php endif; ?>

    </section>

</main>


<footer>
    Roolipelisovellus - 2026
</footer>

</body>
</html>