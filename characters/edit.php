

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
        <input
            type="text"
            name="character_class"
            value="<?= htmlspecialchars($character['character_class']) ?>"
            required
        >
    </div>

    <div>
        <label>Race:</label>
        <input
            type="text"
            name="character_race"
            value="<?= htmlspecialchars($character['character_race']) ?>"
            required
        >
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
</div>

