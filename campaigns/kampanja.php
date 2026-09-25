
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_campania.css">
    <title>Omat kampanjat</title>
</head>

<body>

    <header>
        <h1>Website</h1>
    </header>

    <div id="omat_kampanjat">
        <h1>Omat kampanjat</h1>
    </div>

    <!-- Kampanjan luominen -->
    <div id="btn">
        <button id="luoKampanja">
            Luo kampanja
        </button>
    </div>

    <!-- Kampanjakortit -->
    <div id="kampanjaList"></div>

    <!-- Kampanjan luomisen / muokkaamisen lomake -->
    <div id="kampanjaForm" style="display: none;">

        <h2 id="kampanjaFormOtsikko">Luo uusi kampanja</h2>

        <button type="button" class="close-btn">×</button>

        <!-- Nimi -->
        <label for="kampanjaNimi">Kampanjan nimi:</label>
        <input type="text" id="kampanjaNimi">

        <br><br>

        <!-- Kuvaus -->
        <label for="kampanjaKuvaus">Kuvaus:</label>
        <textarea id="kampanjaKuvaus"></textarea>

        <br><br>

        <!-- Johtaja -->
        <label for="kampanjaJohtaja">Johtaja:</label>
        <input type="text" id="kampanjaJohtaja">

        <br><br>

        <!-- Pelaajat -->
        <label for="kampanjaPelaajat">Pelaajat:</label>
        <input
            type="text"
            id="kampanjaPelaajat"
            placeholder="Esim. Anna, Pekka, Mikko"
        >

        <br><br>

        <!-- Tallenna -->
        <button id="tallennaKampanja">
            Luo kampanja
        </button>

    </div>

    <footer>
        Roolipelisovellus - 2026
    </footer>

    <script src="kampanja.js"></script>

</body>

</html>
