<?php include "includes/header.php"; ?>

<div class="character_creation_form">
    <form method="POST" action="../index.php?page=createCharacter">
        <label for="character_name">Character Name:</label>
        <input name="character_name" type="text" placeholder="...">

        <label for="character_class">Choose a Class:</label>
        <select name="character_class" required>
            <option value="Fighter">Fighter</option>
            <option value="Mage">Mage</option>
            <option value="Ranger">Ranger</option>
            <option value="Bard">Bard</option>
            <option value="Cleric">Cleric</option>
        </select>

        <label for="character_race">Choose a Race:</label>
        <select name="character_race" required>
            <option value="Human">Human</option>
            <option value="Dwarf">Dwarf</option>
            <option value="Elf">Elf</option>
            <option value="Gnome">Gnome</option>
            <option value="Orc">Orc</option>
        </select>

        <button type="submit">Create</button>
        <button type="reset">Reset</button>
    </form>

<p>
    <a href="../index.php?page=dashboard">
        Back to Dashboard
    </a>
</p>

</div>

<?php include "includes/footer.php"; ?>