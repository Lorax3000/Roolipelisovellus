

<div class="character_edit_form">
    <form method="POST" action="../index.php?page=editCharacter">
        <input type="hidden" name="id" value="<?=$character['character_id']?>">

        <label for="character_name">Character Name:</label>
        <input name="character_name" type="text" placeholder="..." value="<?=$character['character_name']?>">

        <label for="character_class">Class</label>
        <select name="character_class" value="<?=$character['character_class']?>">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="character_race">Race</label>
        <input name="character_race" type="text" value="<?=$character['character_race']?>">

        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>
</div>

