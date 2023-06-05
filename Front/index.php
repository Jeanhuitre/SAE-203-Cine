<!DOCTYPE html>
<html lang="fr">
	<head> <!-- commun à toute les pages sauf title dépend de la page -->
		<title>SAE203 - Accueil</title>
		<meta charset="utf-8">
		<meta name="author" content="L.Merino et V.Lefevre">
		<meta name='copyright' content='L.Merino et V.Lefevre'>
		<meta name="keywords" content="SAE203, Bases de données, Intégration Web, Développement Web, Hébergement">
		<meta name='date' content='Apr. 27, 2022'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/sae203.css">
		<script type="text/javascript" src="js/sae203.js"></script>
	</head>
	<body>
		<header> <!-- commun à toute les pages -->
			<nav>
				<ul>
					<li><a class="selected" href="index.php">SAE 203</a></li>
					<li><a href="" class="rubrique">Affichage</a>
						<ul>
							<li><a href="affichage/films.php">Films</a></li>
							<li><a href="affichage/realis.php">Réalisateurs</a></li>
							<li><a href="affichage/salles.php">Salles</a></li>
							<li><a href="affichage/horaires.php">Horaires</a></li>
							<li><a href="affichage/genres.php">Genres</a></li>
						</ul>
					</li>
					<li><a href="" class="rubrique">Insertion</a>
						<ul>
							<li><a href="insertion/films.php">Films</a></li>
							<li><a href="insertion/salles.php">Salles</a></li>
							<li><a href="insertion/proj.php">Projections</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</header>
		<main>

			<h1 class="visible">Accueil</h1> <!-- au moins pour le référencement, changer la classe en invisible si nécessaire -->
			<section>
				<p>Bienvenue, voici le site Web que j'ai réalisé pour la SAE203 - Concevoir un site Web avec une source de données.</p>
				<p>Ajoutez des informations ...</p>
				<div><img src="documents/monimage.jpg" alt="Mon Image" width="auto" height="120"></div> <!-- ajustez la taille -->
				<p class="monom">Mon nom</p> <!-- votre nom sera ajouté automatiquement via le script JS à partir de la balise meta auteur -->
			</section>
		</main>
		<footer> <!-- le même pour toutes les pages -->
			<div id="listpages">
				<a class='selected' href="index.php">Accueil</a><br>
				<span>Affichage</span> > <a href="affichage/films.php">Films</a>, <a href="affichage/realis.php">Réalisateurs</a>, <a href="affichage/salles.php">Salles</a>, <a href="affichage/horaires.php">Horaires</a>, <a href="affichage/genres.php">Genres</a><br>
				<span>Insertion</span> > <a href="insertion/films.php">Films</a>, <a href="insertion/salles.php">Salles</a>, <a href="insertion/proj.php">Projections</a>
			</div>
			<address>
				<span>BUT MMI, 50000 Saint-Lô, France</span>
				<a href="tel:bidon">Tel bidon</a> <!-- généré en JS pour éviter les spams -->
				<a href="mailto:bidon">Email bidon</a>  <!-- généré en JS pour éviter les spams -->
			</address>
			<span>©<span class="monom">Mon Nom</span> - <time datetime="2022-05-02">date</time></span> <!-- votre nom et la date seront ajoutés automatiquement via le script JS à partir des balises meta -->
		</footer>
	</body>
</html>