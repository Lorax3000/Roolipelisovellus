
const kampanjaNimi = document.getElementById("kampanjaNimi");
const kampanjaKuvaus = document.getElementById("kampanjaKuvaus");
const kampanjaJohtaja = document.getElementById("kampanjaJohtaja");
const kampanjaPelaajat = document.getElementById("kampanjaPelaajat");


// Haetaan kampanjan ID osoitteesta
const params = new URLSearchParams(window.location.search);

const kampanjaId = params.get("id");


// Haetaan kampanjat localStoragesta
const kampanjat =
    JSON.parse(localStorage.getItem("kampanjat")) || [];


// Etsitään oikea kampanja
const kampanja = kampanjat.find(function (item) {

    return String(item.id) === String(kampanjaId);

});


// Jos kampanja löytyy
if (kampanja) {

    kampanjaNimi.value = kampanja.nimi;

    kampanjaKuvaus.value = kampanja.kuvaus;

    kampanjaJohtaja.value = kampanja.johtaja;

    kampanjaPelaajat.value = kampanja.pelaajat;

}
