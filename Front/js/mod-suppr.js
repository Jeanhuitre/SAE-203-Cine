/* JS formulaire de modification */

function toggleDeleteFormMod() { /* affiche le formulaire de mofification */
    var deleteFormSection = document.getElementById('modify-section');

    if (deleteFormSection.style.display === 'none') {
        deleteFormSection.style.display = 'block';
    } else {
        deleteFormSection.style.display = 'none';
    }
}

function cancelDeleteFormMod() { /* boutton annuler pour le faire disparaître */
    var deleteFormSection = document.getElementById('modify-section');

    deleteFormSection.style.display = 'none';
}

/* JS formulaire de suppression */

function toggleDeleteFormSuppr() { /* affiche le formulaire de suppression */
    var deleteFormSection = document.getElementById('suppression-section');

    if (deleteFormSection.style.display === 'none') {
        deleteFormSection.style.display = 'block';
    } else {
        deleteFormSection.style.display = 'none';
    }
}

function cancelDeleteFormSuppr() { /* boutton annuler pour le faire disparaître */
    var deleteFormSection = document.getElementById('suppression-section');

    deleteFormSection.style.display = 'none';
}

/* Message d'alerte suppression */

function messageSuppr() {
    document.getElementById("delete-form").addEventListener("submit", function(event) {
    // Empêcher la soumission du formulaire par défaut
    event.preventDefault();

    // Afficher le message d'alerte personnalisé
    var confirmation = confirm('Êtes-vous sûr de vouloir supprimer ce film ?');

    // Vérifier si l'utilisateur a cliqué sur "OK"
    if (confirmation) {
        // Soumettre le formulaire programmatiquement
        this.submit();
    }
    });
}
