
const createButton = document.getElementById("luoKampanja");
const kampanjaForm = document.getElementById("kampanjaForm");
const kampanjaNimi = document.getElementById("kampanjaNimi");
const kampanjaKuvaus = document.getElementById("kampanjaKuvaus");
const kampanjaJohtaja = document.getElementById("kampanjaJohtaja");
const kampanjaPelaajat = document.getElementById("kampanjaPelaajat");
const tallennaKampanja = document.getElementById("tallennaKampanja");
const kampanjaList = document.getElementById("kampanjaList");
const kampanjaFormOtsikko = document.getElementById("kampanjaFormOtsikko");
const closeButton = document.querySelector(".close-btn");

// Tallennetaan kampanjat localStorageen
let kampanjat = JSON.parse(localStorage.getItem("kampanjat")) || [];
let muokattavaKampanja = null;

// Näytetään kaikki tallennetut kampanjat
function naytaKampanjat() {
    kampanjaList.innerHTML = kampanjat.map(k => `
        <div class="kampanja" data-id="${k.id}">
            <button class="poista-kampanja">×</button>
            <h2>${k.nimi}</h2>
            <p>${k.kuvaus}</p>
            <p><strong>Johtaja:</strong> ${k.johtaja}</p>
            <p><strong>Pelaajat:</strong> ${k.pelaajat}</p>
            <button class="muokkaa">Muokkaa</button>
        </div>
    `).join("");
}

// Tyhjennetään kampanjalomake
function tyhjennaForm() {
    kampanjaNimi.value = "";
    kampanjaKuvaus.value = "";
    kampanjaJohtaja.value = "";
    kampanjaPelaajat.value = "";
}

// Tallennetaan muutokset localStorageen
function tallenna() {
    localStorage.setItem("kampanjat", JSON.stringify(kampanjat));
}

naytaKampanjat();

// Avataan lomake uuden kampanjan luomista varten
createButton.addEventListener("click", () => {
    muokattavaKampanja = null;
    tyhjennaForm();

    kampanjaFormOtsikko.textContent = "Luo uusi kampanja";
    tallennaKampanja.textContent = "Luo kampanja";
    kampanjaForm.style.display = "block";
});

// Tallennetaan uusi tai muokattu kampanja
tallennaKampanja.addEventListener("click", () => {
    const nimi = kampanjaNimi.value.trim();

    // Kampanjan nimi on pakollinen
    if (!nimi) return alert("Anna kampanjalle nimi.");

    const data = {
        nimi,
        kuvaus: kampanjaKuvaus.value.trim(),
        johtaja: kampanjaJohtaja.value.trim(),
        pelaajat: kampanjaPelaajat.value.trim()
    };

    // Muokataan olemassa olevaa kampanjaa
    if (muokattavaKampanja) {
        const kampanja = kampanjat.find(
            k => k.id === Number(muokattavaKampanja.dataset.id)
        );

        if (kampanja) Object.assign(kampanja, data);

    // Luodaan uusi kampanja
    } else {
        kampanjat.push({ id: Date.now(), ...data });
    }

    tallenna();
    naytaKampanjat();
    kampanjaForm.style.display = "none";
    tyhjennaForm();
    muokattavaKampanja = null;
});

// Käsitellään kampanjakortin painikkeet
kampanjaList.addEventListener("click", event => {
    const kampanja = event.target.closest(".kampanja");
    if (!kampanja) return;

    // Poistetaan kampanja
    if (event.target.closest(".poista-kampanja")) {
        kampanjat = kampanjat.filter(
            k => k.id !== Number(kampanja.dataset.id)
        );

        tallenna();
        kampanja.remove();
        return;
    }

    // Avataan kampanja muokkausta varten
    if (event.target.closest(".muokkaa")) {
        const tekstit = kampanja.querySelectorAll("p");

        muokattavaKampanja = kampanja;
        kampanjaNimi.value = kampanja.querySelector("h2").textContent;
        kampanjaKuvaus.value = tekstit[0].textContent;
        kampanjaJohtaja.value = tekstit[1].textContent
            .replace("Johtaja:", "").trim();
        kampanjaPelaajat.value = tekstit[2].textContent
            .replace("Pelaajat:", "").trim();

        kampanjaFormOtsikko.textContent = "Muokkaa kampanjaa";
        tallennaKampanja.textContent = "Tallenna muutoksia";
        kampanjaForm.style.display = "block";
    }
});

// Suljetaan kampanjalomake
closeButton.addEventListener("click", () => {
    kampanjaForm.style.display = "none";
});

// Siirrytään kampanjasivulle kaksoisnapsauttamalla korttia
kampanjaList.addEventListener("dblclick", event => {
    if (event.target.closest("button")) return;

    const kampanja = event.target.closest(".kampanja");

    if (kampanja) {
        location.href = `kampanjan_sivu.html?id=${kampanja.dataset.id}`;
    }
});
