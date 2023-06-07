/* JS formulaire de modification */

function toggleDeleteFormMod() {
    var deleteFormSection = document.getElementById('delete-form-section-mod');

    if (deleteFormSection.style.display === 'none') {
        deleteFormSection.style.display = 'block';
    } else {
        deleteFormSection.style.display = 'none';
    }
}

function cancelDeleteFormMod() {
    var deleteFormSection = document.getElementById('delete-form-section-mod');

    deleteFormSection.style.display = 'none';
}

/* JS formulaire de suppression */

function toggleDeleteFormSuppr() {
    var deleteFormSection = document.getElementById('delete-form-section-suppr');

    if (deleteFormSection.style.display === 'none') {
        deleteFormSection.style.display = 'block';
    } else {
        deleteFormSection.style.display = 'none';
    }
}

function cancelDeleteFormSuppr() {
    var deleteFormSection = document.getElementById('delete-form-section-suppr');

    deleteFormSection.style.display = 'none';
}