<?php include "includes/header.php"; ?>

<div class="character_edit_form">

<form method="POST" action="../index.php?page=editCharacter">

    <input
        type="hidden"
        name="id"
        value="<?= htmlspecialchars($character['character_id']) ?>"
    >
    
    <div>
        <label>Health:</label>

        <input
            type="number"
            name="character_health"
            value="<?= htmlspecialchars($character['character_health']) ?>"
            min="0"
            max="9999"
            required
        >
    </div>

    <div>
        <label>Max HP:</label>

        <input
            type="number"
            name="character_max_hp"
            value="<?= htmlspecialchars($character['character_max_hp']) ?>"
            min="1"
            max="9999"
            required
        >
    </div>

    <div>
        <label>Level:</label>

        <input
            type="number"
            name="character_level"
            value="<?= htmlspecialchars($character['character_level']) ?>"
            min="1"
            max="9999"
            required
        >
    </div>

    <div>
        <label>Mana:</label>

        <input
            type="number"
            name="character_mana"
            value="<?= htmlspecialchars($character['character_mana']) ?>"
            min="1"
            max="9999"
            required
        >
    </div>

    <div>
        <label>Strength:</label>

        <input
            type="number"
            name="character_strength"
            value="<?= htmlspecialchars($character['character_strength']) ?>"
            min="1"
            max="9999"
            required
        >
    </div>

    <div>
        <label>Endurance:</label>

        <input
            type="number"
            name="character_endurance"
            value="<?= htmlspecialchars($character['character_endurance']) ?>"
            min="1"
            max="9999"
            required
        >
    </div>

    <div>
        <label>Agility:</label>

        <input
            type="number"
            name="character_agility"
            value="<?= htmlspecialchars($character['character_agility']) ?>"
            min="1"
            max="9999"
            required
        >
    </div>

    <div>
        <label>Intelligence:</label>

        <input
            type="number"
            name="character_intelligence"
            value="<?= htmlspecialchars($character['character_intelligence']) ?>"
            min="1"
            max="9999"
            required
        >
    </div>

    <div>
        <label>Charisma:</label>

        <input
            type="number"
            name="character_charisma"
            value="<?= htmlspecialchars($character['character_charisma']) ?>"
            min="1"
            max="9999"
            required
        >
    </div>

    <div>
        <label>Notes:</label>

        <textarea name="character_notes"><?= htmlspecialchars($character['character_notes']) ?></textarea>
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