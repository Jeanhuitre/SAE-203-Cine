<?php
session_start();

// Vérification de l'authentification
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Utilisateur non authentifié, redirection vers la page de connexion
    header('Location: ../db/auth-proj.php');
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
		<title>SAE203 - Insertion - Projections</title>
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
		<script type="text/javascript" src="js/date.js"></script>
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
							<li><a href="insertion/salles.php">Salles</a></li>
							<li><a class="selected" href="insertion/proj.php">Projections</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</header>
		<main>
			<h1 class="visible">Insertion > Projections</h1>
			<section>

			<?php include('../db/connexion.php') ?>
				
				<form action='insertion/insert-proj.php' method="post"> <!-- à générer en Php -->
					<label for="visa">Nom du film projeté</label> <!-- On demande de sélectionner le nom car la requête renverra le visa associé ! Plus intuitif donc -->
					<select id="visa" name="visa" class="verif"> <!-- générer par ordre alphabétique -->
							<option value="" disabled="disabled" selected="selected">Sélectionnez un visa</option>
							<?php
							try {
								$sql = "SELECT visa, nom FROM FILM GROUP BY visa";
								$res = $dtb->prepare($sql);
    							$res->execute();
								while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) { 
									echo "<option value='".$ligne["visa"]."'>";
									echo $ligne["nom"];
									echo "</option>";
								}
							} catch (PDOException $e) {
								echo "ERREUR : ".$e->getMessage()."<br>";
								exit(0);
							}
							?>
					</select>
					<label for="salle">Salle</label>
					<select id="salle" name="salle" class="verif"> <!-- générer par ordre alphabétique -->
							<option value="" disabled="disabled" selected="selected">Sélectionnez une salle</option>
							<?php
							try {
								$sql = "SELECT nusalle FROM SALLE GROUP BY nusalle";
								$res = $dtb->query($sql);
								while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) { 
									echo "<option value='".$ligne["nusalle"]."'>";
									echo $ligne["nusalle"];
									echo "</option>";
								}
							} catch (PDOException $e) {
								echo "ERREUR : ".$e->getMessage()."<br>";
								exit(0);
							}
							?>
					</select>
					<label for="date">Date de projection</label><span>
					<input type="text" pattern="\d{4}-\d{2}-\d{2}" name="date" id="date" required>
					</span>
					<label for="minutes">Heure de début</label><span><input type="text" name="dureeDeb" pattern="([0-1][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" id="dureeDeb" class="verif"></span>
					<fieldset><input type="submit" id="submit" value="Insérer le film"><input type="reset" value="Effacer" id="reset"></fieldset>
				</form>
				<?php echo $confirmationMessage; ?>
			</section>
		</main>
		<footer> <!-- le même pour toutes les pages -->
		<div id="listpages">
				<a href="index.php">Accueil</a><br>
				<span>Affichage</span> > <a href="affichage/films.php">Films</a>, <a href="affichage/realis.php">Réalisateurs</a>, <a href="affichage/salles.php">Salles</a>, <a href="affichage/horaires.php">Horaires</a>, <a href="affichage/genres.php">Genres</a><br>
				<span class='selected'>Insertion</span> > <a href="insertion/films.php">Films</a>, <a href="insertion/salles.php">Salles</a>, <a href="insertion/proj.php" class='selected'>Projections</a>
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