
document.addEventListener("DOMContentLoaded", () => {

    const playersList = document.getElementById("playersList");

    if (!playersList) {
        return;
    }

    playersList.addEventListener("click", (event) => {

        // Pelaajan poistaminen
        const removeButton = event.target.closest(".remove-player");

        if (removeButton) {
            const playerRow = removeButton.closest(".player-row");

            if (playerRow) {
                playerRow.remove();
            }

            return;
        }


        // Pelaajan tilan vaihtaminen
        const statusButton = event.target.closest(".player-status");

        if (statusButton) {

            if (statusButton.classList.contains("alive")) {

                statusButton.classList.remove("alive");
                statusButton.classList.add("dead");

                statusButton.textContent = "DEAD";

            } else {

                statusButton.classList.remove("dead");
                statusButton.classList.add("alive");

                statusButton.textContent = "ALIVE";
            }
        }

    });

});
