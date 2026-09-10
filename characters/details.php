
<body>

    <div class="character_details">

        <div class="character_details_header">

            <h3>Character Details</h3>

        </div>

        <div class="character_details_body">

            <p>
                <strong>Name:</strong>
                <?= htmlspecialchars($character['character_name']) ?>
            </p>

            <p>
                <strong>Class:</strong>
                <?= htmlspecialchars($character['character_class']) ?>
            </p>

            <p>
                <strong>Race:</strong>
                <?= htmlspecialchars($character['character_race']) ?>
            </p>

            <p>
                <strong>Level:</strong>
                <?= htmlspecialchars($character['character_level']) ?>
            </p>

            <p>
                <strong>Health:</strong>
                <?= htmlspecialchars($character['character_health']) ?>
            </p>

            <p>
                <strong>Mana:</strong>
                <?= htmlspecialchars($character['character_mana']) ?>
            </p>

            <p>
                <strong>Strength:</strong>
                <?= htmlspecialchars($character['character_strength']) ?>
            </p>

            <p>
                <strong>Endurance:</strong>
                <?= htmlspecialchars($character['character_endurance']) ?>
            </p>

            <p>
                <strong>Agility:</strong>
                <?= htmlspecialchars($character['character_agility']) ?>
            </p>

            <p>
                <strong>Intelligence:</strong>
                <?= htmlspecialchars($character['character_intelligence']) ?>
            </p>

            <p>
                <strong>Charisma:</strong>
                <?= htmlspecialchars($character['character_charisma']) ?>
            </p>

            <p>
                <strong>Notes:</strong>
                <?= htmlspecialchars($character['character_notes']) ?>
            </p>

            <p>
                <strong>Status:</strong>
                <?= htmlspecialchars($character['character_status']) ?>
            </p>

        </div>

        <div class="character_detail_buttons">

            <button>
                <a href="index.php?page=showEditCharacter&id=<?= $character['character_id'] ?>">
                    Edit Character
                </a>
            </button>

            <form method="POST" action="index.php?page=deleteCharacter">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $character['character_id'] ?>"
                >

                <button
                    type="submit"
                    onclick="return confirm(`This action is permanent and can't be undone. Delete character?`)"
                >
                    Delete Character
                </button>

            </form>

        </div>

    </div>

</body>
