function verifyFormProj() {
    // Vérification de la durée du début
    // On va chercher l'élément ayant pour ID dureeDeb
    var dureeDebInput = document.getElementById("dureeDeb");
    // On définit le pattern, doit toujours commencer par /^ et finir par $/
    var dureeDebPattern = /^([0-1][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/;
    if (!dureeDebPattern.test(dureeDebInput.value)) { //Si le pattern est différent de la valeur de l'input
      dureeDebInput.setCustomValidity("L'heure du début de la projection doit être au format HH:MM:SS.");
      //setCustomValidity permet de définir le message de validité, dans ce cas, c'est celui d'invalidité
    } else {
      dureeDebInput.setCustomValidity("");
    }
  
    //Vérification de la date
    var inputDate = document.getElementById("date");
    var datePattern = /\d{4}-\d{2}-\d{2}/;
    if (datePattern.test(inputDate.value)) {
      var year = parseInt(inputDate.value.substr(0, 4)); //commence à 0 pour les 4 prochains caractères
      var month = parseInt(inputDate.value.substr(5, 2)); // commence au 5ème caractère pour les 2 prochains
      var day = parseInt(inputDate.value.substr(8, 2)); //commence au 7ème pour les 2 prochains
      var dateObj = new Date(year, month - 1, day);
      if (dateObj.getFullYear() === year && dateObj.getMonth() + 1 === month && dateObj.getDate() === day) {
        inputDate.setCustomValidity("");
      } else {
        inputDate.setCustomValidity("La date est invalide.");
      }
    } else {
      inputDate.setCustomValidity("Le format de la date doit être 'AAAA-MM-JJ'.");
    }
  }

function verifFormSalle() {
    // Vérification du numéro de la salle
    var nusalleInput = document.getElementById("nusalle");
    var nusallePattern = /^[0-9]{1,2}$/;
    if (!nusallePattern.test(nusalleInput.value)) {
        nusalleInput.setCustomValidity("Le numéro de salle que vous avez saisi n'est pas valide, il doit contenir au maximum deux chiffres et être inférieur à 25.");
    } else {
        nusalleInput.setCustomValidity("");
    }

    // Vérification de la capacité
    var capaciteInput = document.getElementById("capacite");
    var capacitePattern = /^[0-9]{1,3}$/;
    if (!capacitePattern.test(capaciteInput.value)) {
        capaciteInput.setCustomValidity("La capacité que vous avez saisie n'est pas valide, elle doit contenir au maximum trois chiffres.");
    } else {
        capaciteInput.setCustomValidity("");
    }
    }

function verifFormFilm () {
    //vérification du nom
    var nomInput = document.getElementById("nom");
    var nomPattern = /^[A-Za-z0-9\s'’]{1,100}$/;
    if (!nomPattern.test(nomInput.value)) {
        nomInput.setCustomValidity("Le nom que vous avez entré ne peut contenir que des minuscules, des majuscules, des chiffres, des espaces et des apostrophes.");
    } else {
        nomInput.setCustomValidity("");
    }

    //vérification du visa
    var visaInput = document.getElementById("visa");
    var visaPattern = /^[0-9]{1,10}$/;
    if (!visaPattern.test(visaInput.value)) {
        visaInput.setCustomValidity("Le visa que vous avez rentré ne peut contenir que 10 chiffres. Les lettres et les caractères spéciaux ne sont pas autorisés");
    } else {
        visaInput.setCustomValidity("");
    }

    //vérification de la durée
    var visaInput = document.getElementById("minutes");
    var visaPattern = /^([0-1][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/;
    if (!visaPattern.test(visaInput.value)) {
        visaInput.setCustomValidity("La durée du film projeté doit être au format HH:MM:SS.");
    } else {
        visaInput.setCustomValidity("");
    }

    //vérification de la durée
    var visaInput = document.getElementById("synopsis");
    var visaPattern = /^[A-Za-z0-9\s',.!?]{1,1500}$/;
    if (!visaPattern.test(visaInput.value)) {
        visaInput.setCustomValidity("Vous ne pouvez pas dépasser les 1500 caractères dans votre résumé, ni utiliser de tiret, de slash ou de parenthèse.");
    } else {
        visaInput.setCustomValidity("");
    }
}

function verifFormModifFilm () {
    //vérification du nom modifié
    var nomInput = document.getElementById("modif_nom");
    var nomPattern = /^[A-Za-z0-9\s'’]{1,100}$/;
    if (!nomPattern.test(nomInput.value)) {
        nomInput.setCustomValidity("Le nom que vous avez entré ne peut contenir que des minuscules, des majuscules, des chiffres, des espaces et des apostrophes.");
    } else {
        nomInput.setCustomValidity("");
    }

    //vérification du synopsis modifié
    var visaInput = document.getElementById("modif_synopsis");
    var visaPattern = /^[A-Za-z0-9\s',.!?]{1,1500}$/;
    if (!visaPattern.test(visaInput.value)) {
        visaInput.setCustomValidity("Vous ne pouvez pas dépasser les 1500 caractères dans votre résumé, ni utiliser de tiret, de slash ou de parenthèse.");
    } else {
        visaInput.setCustomValidity("");
    }
}

function verifAuth() {
    //vérification de l'identifiant
    var loginInput = document.getElementById("login");
    var loginPattern = /^[A-Za-z0-9]{4,40}$/;
    if (!loginPattern.test(loginInput.value)) {
        loginInput.setCustomValidity("Veuillez vérifier votre identifiant.");
    } else {
        loginInput.setCustomValidity("");
    }

    //vérification du mot de passe
    var passwdInput = document.getElementById("passwd");
    var passwdPattern = /^[A-Za-z0-9]{4,40}$/;
    if (!loginPattern.test(passwdInput.value)) {
        passwdInput.setCustomValidity("Veuillez vérifier votre mot de passe.");
    } else {
        passwdInput.setCustomValidity("");
    }
}