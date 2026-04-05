/* ============================
   MODALE : ouvrir / fermer
============================ */

function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = "block";
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = "none";
    }
}

/* Fermer la modale en cliquant à l'extérieur */
window.addEventListener("click", function (event) {
    const modals = document.querySelectorAll(".modal");
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});

/* ============================
   CONFIRMATION DE SUPPRESSION
============================ */

function confirmDelete(message = "Voulez-vous vraiment supprimer cet élément ?") {
    return confirm(message);
}
/* ============================
   MENU MOBILE
============================ */

function toggleMenu() {
    const nav = document.getElementById("navLinks");
    nav.classList.toggle("show");
}