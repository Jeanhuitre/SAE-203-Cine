<!DOCTYPE html>
<html lang="fr">
	<head> <!-- commun à toute les pages sauf title dépend de la page -->
		<title>SAE203 - Insertion - Connexion</title>
		<meta charset="utf-8">
		<base href="../">
		<meta name="author" content="L.Merino et V.Lefevre">
		<meta name='copyright' content='L.Merino et V.Lefevre'>
		<meta name="keywords" content="SAE203, Bases de données, Intégration Web, Développement Web, Hébergement">
		<meta name='date' content='Apr. 27, 2022'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/sae203.css">
		<link rel="stylesheet" type="text/css" href="css/insertion.css">
		<script type="text/javascript" src="js/sae203.js"></script>
		<script type="text/javascript">
			
			// compléter avec le code local au fichier
			document.addEventListener('DOMContentLoaded', function() {
			// variables globales, à compléter
			const login = document.getElementById('login');
			const passwd = document.getElementById('passwd');
			const err = document.getElementById('erreur');

			// fonction cacherErreur (change la classe du paragraphe)
			function cacherErreur() {
				// Supprimer le paragraphe de message d'erreur
				if (err) {
				err.innerHTML = '';
				}

				// supprimer l’écouteur pour le champ de login
				login.removeEventListener('input', cacherErreur);
				// supprimer l'écouteur pour le champ de mot de passe
				passwd.removeEventListener('input', cacherErreur);
			}

			// ajout des écouteurs sur l’événement input
			login.addEventListener('input', cacherErreur);
			passwd.addEventListener('input', cacherErreur);
			});

		</script>
	</head>
	<body>
		<header> <!-- attention à la différence du menu, on ne peut revenir qu'à l'accueil -->
			<nav>
				<ul>
					<li><a href="index.php">SAE 203</a></li>
				</ul>
			</nav>
		</header>
		<!-- partie principale -->
		<main>
			<h1 class="visible">Insertion > Connexion</h1>
			<section>
				<p>Veuillez vous authentifier pour accéder au mode insertion.</p>
				<!-- Formulaire d'authentification -->
				<form action="db/verifLogin-salles.php" method="POST">
					<label for="login">Login</label><input type="text" pattern="[A-Za-z0-9]{4,40}" id="login" name="login" required>
					<label for="passwd">Mot de passe</label><input type="password" pattern="[\w!@#$%^&*()-+=]{4,40}" id="passwd" name="mdp" required>
					<fieldset><input type="submit" id="submit" value="Connexion"><input type="reset" value="Effacer" id="reset"></fieldset>
				</form>
				<?php
					if (isset($GLOBALS['msgErreurSaisie'])) {
					echo "<p id='erreur' style='color:red'>".$GLOBALS['msgErreurSaisie']."</p>";
					}
				?>
			</section>
		</main>
		<!-- Footer -->
		<footer> <!-- le même pour toutes les pages -->
		<div id="listpages">
				<a href="index.php">Accueil</a><br>
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