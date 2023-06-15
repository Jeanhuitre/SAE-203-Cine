<?php
session_start();

// Vérification de l'authentification
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Utilisateur non authentifié, redirection vers la page de connexion
    header('Location: ../db/auth-films.php');
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
		<title>SAE203 - Insertion - Films</title>
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
		<script type="text/javascript" src="js/mod-suppr.js"></script>
		<script type="text/javascript" src="js/pattern.js"></script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
			document.getElementById('inserSubmit').addEventListener('click', verifFormFilm);
		});

		document.addEventListener('DOMContentLoaded', function() {
			document.getElementById('modifSubmit').addEventListener('click', verifFormModifFilm);
		});
		</script>
		
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
							<li><a class="selected" href="insertion/films.php">Films</a></li>
							<li><a href="insertion/salles.php">Salles</a></li>
							<li><a href="insertion/proj.php">Projections</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</header>
		<main>
			<h1 class="visible">Insertion > Films</h1>
			
			<h2>Formulaire d'insertion</h2>

			<section>

			<?php include('../db/connexion.php') ?>

				<form action='insertion/insert-film.php' method="post"> <!-- à générer en Php -->
					<label for="nom">Nom</label><input type="text" id="nom" name="nom" required>
					<label for="visa">Visa</label><input type="text" id="visa" name="visa" required>
					<label for="minutes">Durée</label><span><input type="text" name="duree" id="minutes" required></span>
					<label for="rea">Réalisateur</label>
					<select id="rea" name="rea"> <!-- générer par ordre alphabétique -->
						<option value="" disabled="disabled" selected="selected">Sélectionnez un réalisateur</option>
						<?php
						try {
							$sql = "SELECT CONCAT(r.nom, ' ', r.prenom) AS rname, r.idreal FROM REALISATEUR AS r GROUP BY r.idreal";
    						$res = $dtb->prepare($sql);
    						$res->execute();
							while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) { 
								echo "<option value='".$ligne["idreal"]."'>";
								echo $ligne["rname"];
								echo "</option>";
							}
						} catch (PDOException $e) {
							echo "ERREUR : ".$e->getMessage()."<br>";
							exit(0);
						}
						?>
					</select>

					</select>
					<label for="genre">Genre</label>
					<select id="genre" name="genre" class="entities"> <!-- générer par ordre alphbétique -->
						<option value="" disabled="disabled" selected="selected">Sélectionnez un genre</option>
						<option>Action</option>
						<option>Aventure</option>
						<option>Cartoon</option>
						<option>Fantastique</option>
						<option>Horreur</option>
						<option>Policier</option>
						<option>Animation</option>
						<option>Documentaire</option>
					</select>
					<label for="resume">Résumé</label><textarea id="synopsis" name="synopsis" pattern="[A-Za-z0-9\s',.!?]{1,1500}" class="entities" required></textarea>
					<fieldset><input type="submit" id="inserSubmit" value="Insérer le film"><input type="reset" value="Effacer" id="reset"></fieldset>
				</form>
				<?php echo "</br>".$confirmationMessage; ?>

			</section>

			<br><br>

			<button onclick="toggleDeleteFormMod()">Afficher le formulaire de modification</button>
			<button onclick="toggleDeleteFormSuppr()">Afficher le formulaire de suppression</button>

			<section id="modify-section" style="display: none;"> <!--Formulaire de modification de film-->
    		<h2 id="modify-title">Modifier un film</h2>
			
			<form id="modify-form" class="hidden" action="insertion/modify-film.php" method="POST">
				<label for="movie-id">Film à modifier :</label>
				<select name="selectFilm" id="modif_selectFilm" required>
				<option value="" disabled="disabled" selected="selected">Sélectionnez un film à modifier</option>
					<?php
						try {
							$sql = "SELECT f.visa, f.nom from FILM f Group by f.visa";
							$stmt=$dtb->prepare($sql);
							$stmt->execute();

							while ($ligne = $stmt->fetchAll(PDO::FETCH_OBJ)) {
								foreach ($ligne as $value) {
									if ($value->nom == $selectFilm) {
										echo "<option selected='selected' value='".$value->visa."'>".$value->nom."</option>";
									} else {
										echo "<option value='".$value->visa."'>".$value->nom."</option>";
									}
								}
							}
						} catch (PDOException $e) {
							echo "Erreur :".$e -> getMessage()."<br/>";
							exit(0);	
						}
					?>

					</select>
					<label for="nom">Nouveau nom</label><input type="text" id="modif_nom" name="nom" required>
					<label for="rea">Nouveau réalisateur</label>
					<select id="modif_rea" name="rea" required> <!-- générer par ordre alphabétique -->
						<option value="" disabled="disabled" selected="selected">Sélectionnez un réalisateur</option>
						<?php
						try {
							$sql = "SELECT CONCAT(r.nom, ' ', r.prenom) AS rname, r.idreal FROM REALISATEUR AS r GROUP BY r.idreal";
    						$res = $dtb->prepare($sql);
    						$res->execute();
							while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) { 
								echo "<option value='".$ligne["idreal"]."'>";
								echo $ligne["rname"];
								echo "</option>";
							}
						} catch (PDOException $e) {
							echo "ERREUR : ".$e->getMessage()."<br>";
							exit(0);
						}
						?>
					</select>
					</select>
					<label for="genre">Nouveau genre</label>
					<select id="modif_genre" name="genre" class="entities"> <!-- générer par ordre alphbétique -->
						<option value="" disabled="disabled" selected="selected">Sélectionnez un genre</option>
						<option>Action</option>
						<option>Aventure</option>
						<option>Cartoon</option>
						<option>Fantastique</option>
						<option>Horreur</option>
						<option>Policier</option>
						<option>Animation</option>
						<option>Documentaire</option>
					</select>
					<label for="resume">Nouveau résumé</label><textarea id="modif_synopsis" name="synopsis" class="entities" required></textarea>
				
				<input type="submit" value="modifier" id="modifSubmit">
				<button type="button" onclick="cancelDeleteFormMod()">Annuler</button>
			</form>
			</section>
			
			<section id="suppression-section" style="display: none;"> <!--Formulaire de suppression de film-->
    		<h2 id="delete-title">Supprimer un film</h2>
			
			<form id="delete-form" class="hidden" action="insertion/delete-film.php" method="POST">
				<label for="movie-id">ID du film à supprimer :</label>
				<select name="selectFilm" id="selectFilm">
				<option value="" disabled="disabled" selected="selected">Sélectionnez un film à supprimer</option>
					<?php
						try {
							$sql = "SELECT f.visa, f.nom from FILM f Group by f.visa";
							$stmt=$dtb->prepare($sql);
							$stmt->execute();

							while ($ligne = $stmt->fetchAll(PDO::FETCH_OBJ)) {
								foreach ($ligne as $value) {
									if ($value->nom == $selectFilm) {
										echo "<option selected='selected' value='".$value->visa."'>".$value->nom."</option>";
									} else {
										echo "<option value='".$value->visa."'>".$value->nom."</option>";
									}
								}
							}
						} catch (PDOException $e) {
							echo "Erreur :".$e -> getMessage()."<br/>";
							exit(0);	
						}
					?>
				
				<input type="submit" id="submit" value="Supprimer" onclick="messageSuppr()">
				<button type="button" onclick="cancelDeleteFormSuppr()">Annuler</button>
			</form>
			</section>

		</main>
		<footer> <!-- le même pour toutes les pages -->
		<div id="listpages">
				<a href="index.php">Accueil</a><br>
				<span>Affichage</span> > <a href="affichage/films.php">Films</a>, <a href="affichage/realis.php">Réalisateurs</a>, <a href="affichage/salles.php">Salles</a>, <a href="affichage/horaires.php">Horaires</a>, <a href="affichage/genres.php">Genres</a><br>
				<span class='selected'>Insertion</span> > <a href="insertion/films.php" class="selected">Films</a>, <a href="insertion/salles.php">Salles</a>, <a href="insertion/proj.php">Projections</a>
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