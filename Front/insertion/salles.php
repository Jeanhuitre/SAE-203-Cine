<?php
session_start();

// Vérification de l'authentification
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Utilisateur non authentifié, redirection vers la page de connexion
    header('Location: ../db/auth-salles.php');
    exit();
}

if (isset($GLOBALS['confirm'])) {
    $confirmationMessage = "<p style='color:green'>" . $GLOBALS['confirm'] . "</p>";
} else {
    $confirmationMessage = "";
}
?>
<!DOCTYPE html>
<html lang="fr">
	<head> <!-- commun à toute les pages sauf title dépend de la page -->
		<title>SAE203 - Insertion - Salles</title>
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
	</head>
	<body>
		<header> <!-- commun à toute les pages sauf les chemins -->
			<nav>
				<ul>
					<li><a href="index.php">SAE 203</a></li>
					<li><a href="" class="rubrique">Affichage</a>
						<ul>
							<li><a href="affichage/films.php">Films</a></li>
							<li><a href="affichage/realis.php">Réalisateurs</a></li>
							<li><a href="affichage/salles.php">Salles</a></li>
							<li><a href="affichage/horaires.php">Horaires</a></li>
							<li><a href="affichage/genres.php">Genres</a></li>
						</ul>
					</li>
					<li><a href="" class="rubrique selected">Insertion</a>
						<ul>
							<li><a href="insertion/films.php">Films</a></li>
							<li><a class="selected" href="insertion/salles.php">Salles</a></li>
							<li><a href="insertion/proj.php">Projections</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</header>
		<main>
			<h1 class="visible">Insertion > Salles</h1>
			<section>

			<?php include('../db/connexion.php') ?>
				
				<form action='insertion/insert-salles.php' method="post"> <!-- à générer en Php -->
					<label for="nusalle">Numéro de salle</label><span><input type="text" pattern="[0-9]{1,2}" name="nusalle" id="nusalle" required></span>
					<label for="capacite">Capacité maximale</label><span><input type="text" pattern="[0-9]{1,3}" name="capacite" id="capacite" required></span>
					<fieldset><input type="submit" id="submit" value="Création de la salle"><input type="reset" value="Effacer" id="reset"></fieldset>
				</form>
				<?php echo $confirmationMessage; ?>
			</section>
		</main>
		<footer> <!-- le même pour toutes les pages -->
		<div id="listpages">
				<a href="index.php">Accueil</a><br>
				<span>Affichage</span> > <a href="affichage/films.php">Films</a>, <a href="affichage/realis.php">Réalisateurs</a>, <a href="affichage/salles.php">Salles</a>, <a href="affichage/horaires.php">Horaires</a>, <a href="affichage/genres.php">Genres</a><br>
				<span class='selected'>Insertion</span> > <a href="insertion/films.php">Films</a>, <a href="insertion/salles.php" class='selected'>Salles</a>, <a href="insertion/proj.php">Projections</a>
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