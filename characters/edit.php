<?php include "includes/header.php"; ?>

<div class="character_edit_form">
<form method="POST" action="../index.php?page=editCharacter">

    <input
        type="hidden"
        name="id"
        value="<?= $character['character_id'] ?>"
    >

    <div>
        <label>Name:</label>
        <input
            type="text"
            name="character_name"
            value="<?= htmlspecialchars($character['character_name']) ?>"
            required
        >
    </div>

    <div>
        <label>Class:</label>

        <select name="character_class" required>
            <option value="1" <?= $character['character_class'] == '1' ? 'selected' : '' ?>>
                1
            </option>

            <option value="2" <?= $character['character_class'] == '2' ? 'selected' : '' ?>>
                2
            </option>

            <option value="3" <?= $character['character_class'] == '3' ? 'selected' : '' ?>>
                3
            </option>

            <option value="4" <?= $character['character_class'] == '4' ? 'selected' : '' ?>>
                4
            </option>

            <option value="5" <?= $character['character_class'] == '5' ? 'selected' : '' ?>>
                5
            </option>
        </select>
    </div>

    <div>
        <label>Race:</label>

        <select name="character_race" required>
            <option value="1" <?= $character['character_race'] === '1' ? 'selected' : '' ?>>
                1
            </option>

            <option value="2" <?= $character['character_race'] === '2' ? 'selected' : '' ?>>
                2
            </option>

            <option value="3" <?= $character['character_race'] === '3' ? 'selected' : '' ?>>
                3
            </option>

            <option value="4" <?= $character['character_race'] === '4' ? 'selected' : '' ?>>
                4
            </option>

            <option value="5" <?= $character['character_race'] === '5' ? 'selected' : '' ?>>
                5
            </option>
        </select>
    </div>

    <div>
        <label>Notes:</label>
        <textarea name="character_notes" required><?= htmlspecialchars($character['character_notes']) ?></textarea>
    </div>

    <div>
        <label>Status:</label>

        <select name="character_status" required>

            <option value="alive"
                <?= $character['character_status'] === 'alive' ? 'selected' : '' ?>>
                Alive
            </option>

            <option value="dead"
                <?= $character['character_status'] === 'dead' ? 'selected' : '' ?>>
                Dead
            </option>

        </select>
    </div>

    <button type="submit">
        Save Changes
    </button>

</form>

<p>
    <a href="../index.php?page=dashboard">
        Back to Dashboard
    </a>
</p>

</div>

<?php include "includes/footer.php"; ?>