// compléter avec le code local au fichier
addEventListener('DOMContentLoaded',function(){
			
	// variables globales
	const fichierPhp = "affichage/genres.php";
	const selectGenre = document.getElementById('selectGenre'); // la liste de genres
	const selectFilm = document.getElementById('selectFilm');
	const para = document.querySelector('main>section>form>p');
	const submit = document.querySelector("main>section>form>input[type='submit']");
	var B = document.getElementById('B').textContent;

	// ------------------
	// gestion de l'accès aux données des listes
	if (selectGenre.value == "defaut") {
		selectFilm.setAttribute("disabled", "disabled");
		para.textContent = "Aucun genre sélectionné";
		submit.setAttribute('disabled','disabled');
	} else if (B != 'page2') {
		selectFilm.value = "defaut";
		para.textContent = "Aucun film sélectionné.";
		submit.setAttribute('disabled','disabled');
	} else {
		para.textContent = selectFilm.selectedOptions[0].innerText + " sélectionné.";
	}

	// ------------------
	// comportement sur sélection d'un genre : soumet le formulaire pour récupérer la liste des films associés au genre sélectionné
	selectGenre.addEventListener("change", function(event) {		
		const form = event.currentTarget.parentNode;
		form.action = fichierPhp;
		selectFilm.value = "defaut";
		form.submit();
	});

	// ------------------
	// comportement sur sélection d'un film : active le bouton
	selectFilm.addEventListener('change', function() {
		if (selectFilm.value == "defaut") {
			submit.setAttribute('disabled', 'disabled');
			para.textContent = "Aucun film sélectionné.";
		} else {
			para.textContent = selectFilm.selectedOptions[0].innerText+" sélectionné.";
			submit.removeAttribute('disabled');
		}
	});
});