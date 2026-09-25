
// MUISTIINPANOJEN HALLINTA


const addNoteBtn = document.getElementById("addNoteBtn");
const notesList = document.getElementById("notesList");



// UUDEN MUISTIINPANON LISÄÄMINEN


addNoteBtn.addEventListener("click", () => {

    // Luodaan ikkuna uuden muistiinpanon kirjoittamista varten
    const modal = document.createElement("div");

    modal.className = "note-modal";

    modal.innerHTML = `
        <div class="note-modal-content">

            <h3>UUSI MUISTIINPANO</h3>

            <textarea
                class="note-input"
                placeholder="Kirjoita muistiinpano..."
            ></textarea>

            <div class="note-modal-buttons">

                <button class="note-cancel-btn">
                    CANCEL
                </button>

                <button class="note-save-btn">
                    ADD NOTE
                </button>

            </div>

        </div>
    `;

    document.body.appendChild(modal);


    const textarea = modal.querySelector(".note-input");
    const cancelBtn = modal.querySelector(".note-cancel-btn");
    const saveBtn = modal.querySelector(".note-save-btn");


    // Kohdistetaan kursori automaattisesti tekstikenttään
    textarea.focus();


  
    // PERUUTETAAN MUISTIINPANON LISÄÄMINEN
   

    cancelBtn.addEventListener("click", () => {
        modal.remove();
    });


   
    // TALLENNETAAN MUISTIINPANO
   

    saveBtn.addEventListener("click", () => {

        const text = textarea.value.trim();

        // Tyhjää muistiinpanoa ei lisätä
        if (!text) {
            return;
        }


        // Luodaan uusi muistiinpanokortti
        const note = document.createElement("div");
        note.className = "muistiinpano";

       note.innerHTML = `
    <div class="note-buttons">

        <button type="button" class="edit-note">
            EDIT
        </button>

        <button type="button" class="remove-note">
            ×
        </button>

    </div>

    <h3>MUISTIINPANO</h3>
    <p></p>
`;


        // Lisätään käyttäjän teksti turvallisesti
        note.querySelector("p").textContent = text;

        notesList.appendChild(note);

        modal.remove();
    });

});


// MUISTIINPANON POISTAMINEN JA MUOKKAAMINEN


notesList.addEventListener("click", (event) => {

    const editButton = event.target.closest(".edit-note");

    if (editButton) {

        const note = editButton.closest(".muistiinpano");

        if (note) {

            const oldText = note.querySelector("p").textContent;

            const newText = prompt("Muokkaa muistiinpanoa:", oldText);

            if (newText !== null && newText.trim() !== "") {
                note.querySelector("p").textContent = newText.trim();
            }

        }

        return;
    }

    const removeButton = event.target.closest(".remove-note");

    if (!removeButton) {
        return;
    }

    const note = removeButton.closest(".muistiinpano");

    if (note) {
        note.remove();
    }

});
