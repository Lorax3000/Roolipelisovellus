<?php include "includes/header.php"; ?>

<div class="character_creation_form">
    <form method="POST" action="../index.php?page=createCharacter">
        <label for="character_name">Character Name:</label>
        <input name="character_name" type="text" placeholder="...">

        <label for="character_class">Choose a Class:</label>
        <select name="character_class" required>
            <option value="1" <?= $character['character_class'] == '1' ? 'selected' : '' ?>>1</option>
            <option value="2" <?= $character['character_class'] == '2' ? 'selected' : '' ?>>2</option>
            <option value="3" <?= $character['character_class'] == '3' ? 'selected' : '' ?>>3</option>
            <option value="4" <?= $character['character_class'] == '4' ? 'selected' : '' ?>>4</option>
            <option value="5" <?= $character['character_class'] == '5' ? 'selected' : '' ?>>5</option>
        </select>

        <label for="character_race">Choose a Race:</label>
        <input name="character_race" type="text">

        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>

<p>
    <a href="../index.php?page=dashboard">
        Back to Dashboard
    </a>
</p>

</div>

<?php include "includes/footer.php"; ?>