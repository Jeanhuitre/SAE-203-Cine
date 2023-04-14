// code JS SAE203

// Menu
function menu() {
	
	//récupération du li affichage
	const ulAffiche = document.querySelector("header > nav > ul > li:nth-of-type(2) > ul");
	// recuperation du li insertion
	const ulInsert = document.querySelector("header > nav > ul > li:last-of-type > ul");
	//récupération des liens
	const ulAfficheLink = document.querySelector("header > nav > ul > li:nth-of-type(2) > a");
	const ulInsertLink = document.querySelector("header > nav > ul > li:last-of-type > a");
	
	//ajout d'un écouteur
	ulAfficheLink.addEventListener("click", function(evt) {
		evt.preventDefault(); //si pas clique, se passe rien
		if(ulInsert.classList.contains("visible"))
			ulInsertLink.classList.toggle("visible");
		ulAffiche.classList.toggle("visible");
	});

	ulInsertLink.addEventListener("click", function(event) {
		event.preventDefault();
		if(ulAffiche.classList.contains("visible"))
			ulAffiche.classList.toggle("visible");
		ulInsert.classList.toggle("visible");
	});

	ulAffiche.parentNode.addEventListener("mouseleave", function(event) {
		if (ulAffiche.classList.contains("visible"))
		ulAffiche.classList.toggle("visible");
	});

	ulInsert.parentNode.addEventListener("mouseleave", function(event){
		if(ulInsert.classList.contains("visible"))
			ulInsert.classList.toggle("visible");
	});
}

// Monom
function monom() {
	const nom = document.querySelector('meta[name="author"]').getAttribute("content");
	const monomList = document.getElementsByClassName('monom');
	for (let i = 0; i < monomList.length; i++)
		monomList[i].textContent = nom;
}

// Footer
function footer() {
	const dateNode = document.querySelector("footer > span > time");
	const dateCreation = new Date(dateNode.getAttribute("datetime"));
	dateNode.textContent = dateCreation.toLocaleDateString();

	// pour le numéro de téléphone
	const telNum = [2,3,0,5,0,0,3,0]; // le vrai tel est +33 2 33 33 50 00
	const telId = [1,6,6,1,3,5,7,2]; // positions dans telNum pour obtenir le numéro
	// récupérer le nœud a du téléphone
	let telNode = document.querySelector('footer>address>a:first-of-type');
	let txt = "+332";
	// reconstruire le numéro à partir des tableaux
	for (let i = 0; i < telId.length; i++) txt += telNum[telId[i]];
	// écraser la valeur de l’attribut et le contenu de la balise a
	telNode.setAttribute('href',"tel:"+txt);
	telNode.innerText = "Phone: "+txt;

	// pour le mail
	const email = ["t", "mo", "b", "n", "l", "u", "o", "i", "m", "s", "@", ".", "c"];
	const emailId = [1, 3, 6, 8, 10, 2, 6, 7, 0, 11, 12, 6, 8];
	txt = "";
	for (let i = 0; i < email.length; i++) 
	txt += email[emailId[i]];
	let emailNode = document.querySelector('footer > address > a:last-of-type');
	emailNode.setAttribute("href", "mailto:"+txt);
	emailNode.innerText = "Email: " + txt;
}

// Fonction principale
window.addEventListener('DOMContentLoaded',function() {

	// fonctionnalités du menu
	menu();

	// ajouter l'auteur au contenu de classe monom
	monom();

	// générer les éléments du footer
	footer();

});