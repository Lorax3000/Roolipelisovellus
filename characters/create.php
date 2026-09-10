

<div class="character_creation_form">
    <form method="POST" action="../index.php?page=createCharacter">
        <label for="character_name">Character Name:</label>
        <input name="character_name" type="text" placeholder="...">

        <label for="character_class">Choose a Class:</label>
        <select name="character_class">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="character_race">Choose a Race:</label>
        <input name="character_race" type="text">

        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>
</div>

