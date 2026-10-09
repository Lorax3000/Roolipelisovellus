# Roolipelisovellus

Selainpohjainen roolipelisovellus, jossa käyttäjät voivat luoda omia hahmojaan ja hallita kampanjoita. Sovellus sisältää myös yksinkertaisen vuoropohjaisen taistelujärjestelmän.

## Tekijät

* Mikko P
* Elias L
* Liidia M

## Sovelluksesta

Roolipelisovellus on tarkoitettu roolipelien pelaajille, jotka haluavat luoda hahmoja ja hallita omia pel kampanjoitaan. Sovelluksessa voi luoda hahmoja, perustaa kampanjoita ja kutsua muita käyttäjiä mukaan pelaamaan.

Kampanjan pelinjohtaja voi hallita kampanjaa, lisätä pelaajia ja hahmoja sekä kirjoittaa muistiinpanoja. Sovelluksessa on myös yksinkertainen taistelujärjestelmä.

## Ominaisuudet

* Käyttäjän rekisteröityminen ja kirjautuminen
* Hahmojen luominen, tarkastelu, muokkaaminen ja poistaminen
* Kampanjoiden luominen ja hallinta
* Pelaajien kutsuminen kampanjoihin
* Kutsujen hyväksyminen
* Hahmojen lisääminen kampanjoihin
* Pelaajien tilan hallinta
* Kampanjoiden muistiinpanot
* Kampanjoiden arkistointi
* Yksinkertainen taistelujärjestelmä
* Hahmojen kokemuspisteet ja tasojen kehitys

## Teknologiat

* HTML
* CSS
* JavaScript
* PHP
* MySQL / MariaDB
* PDO
* Git ja GitHub

## Vaatimukset

Sovelluksen paikalliseen suorittamiseen tarvitaan:

* PHP
* MySQL tai MariaDB
* Apache-verkkopalvelin tai muu PHP:tä tukeva palvelin
* Verkkoselain

Suositeltu paikallinen kehitysympäristö on esimerkiksi XAMPP.

## Asennus

1. Kloonaa repository omalle tietokoneellesi.
2. Siirrä projekti paikallisen verkkopalvelimen hakemistoon.
3. Luo sovellukselle tietokanta MySQL:ssä tai MariaDB:ssä.
4. Tuo tarvittavat tietokantataulut SQL-tiedostosta, jos sellainen sisältyy projektiin.
5. Muokkaa tietokantayhteyden asetukset vastaamaan omaa ympäristöäsi.
6. Käynnistä Apache ja tietokantapalvelin.

## Tietokanta

Sovellus käyttää MySQL- tai MariaDB-tietokantaa tietojen tallentamiseen.

Tietokantaan tallennetaan muun muassa käyttäjiä, hahmoja, kampanjoita, kampanjoiden pelaajia ja muistiinpanoja.

Tietokanta luodaan tuomalla projektin mukana tuleva SQL-tiedosto tietokantapalvelimeen. Jos SQL-tiedostoa ei ole mukana, tarvittavat taulut on luotava erikseen.

## Konfiguraatio

Ennen käynnistämistä tietokantayhteyden asetukset pitää määrittää paikallista ympäristöä vastaaviksi.

Asetuksiin kuuluvat esimerkiksi:

* Tietokannan nimi
* Tietokantapalvelimen osoite
* Tietokannan käyttäjätunnus
* Tietokannan salasana

Älä julkaise oikeita tietokantasalasanoja GitHubissa.

## Käynnistäminen

1. Käynnistä Apache ja MySQL/MariaDB.
2. Varmista, että tietokanta ja sen asetukset ovat kunnossa.
3. Avaa selain.
4. Siirry paikallisen palvelimen projektiosoitteeseen, esimerkiksi `http://localhost/Roolipelisovellus/`.

## Testitunnukset

Testitunnuksia ei ole määritetty tässä README-tiedostossa.

Voit luoda uuden käyttäjän rekisteröitymissivun kautta.

## Tunnetut ongelmat

* Taistelujärjestelmä on yksinkertainen.
* Hahmojen kokemuspisteet eivät säily sivustolta poistuttaessa.

## Tulevaisuuden kehitysideat

* Hahmojen kokemuspisteiden ja tason tallentaminen tietokantaan
* Kutsujen hylkääminen
* Hahmojen poistaminen kampanjoista
* Salasanan vaihtaminen
* Taistelujärjestelmän laajentaminen
* Lisää ominaisuuksia pelinjohtajalle ja pelaajille