
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Web</title>
    <link rel="stylesheet" href="style_kampanjan_sivu.css">
</head>

<body>

<header>
    <h1>WEB</h1>
</header>

<main class="game-layout">

    <!-- KAMPANJA -->

    <section class="campaigns-section">

        <div class="section-title">
            <h2>KAMPANJAN NIMI</h2>
        </div>

        <div class="campaigns-content">
            <h3>KAMPANJAN KUVAUS</h3>
        </div>

    </section>


    <!-- PELAAJAT -->

    <section class="players-section">

        <div class="section-title">
            <h2>PELINOHJAAJA</h2>
        </div>

        <div class="players-header">
            <h3>PLAYERS</h3>
            <h3>STATUS</h3>
        </div>

        <div id="playersList" class="players-list">
            <!-- Pelaajat lisätään JavaScriptillä -->
        </div>

        <div class="add-player-wrapper">
            <button id="addPlayerBtn" class="add-player-btn" type="button">
                + ADD PLAYER
            </button>
        </div>

    </section>


    <!-- PELIN ALOITUS -->

    <section class="start-section">

        <button id="startGameBtn" class="start-game-btn" type="button">
            START GAME
        </button>

        <button id="addNoteBtn" class="add-note-btn" type="button">
            + ADD NOTE
        </button>

    </section>


    <!-- MUISTIINPANOT -->

    <section class="notes-section">

        <div class="section-title">
            <h2>MUISTIINPANOT</h2>
        </div>

        <div id="notesList" class="notes-list">
            <!-- Muistiinpanot lisätään JavaScriptillä -->
        </div>

    </section>

</main>

<footer>
    Roolipelisovellus - 2026
</footer>

<script src="kampanja.js"></script>
<script src="players.js"></script>
<script src="notes.js"></script>

</body>
</html>