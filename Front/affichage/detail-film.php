<!DOCTYPE html>
<html lang="fr">
	<head> <!-- commun à toute les pages sauf title dépend de la page -->
		<title>SAE203 - Affichage - Détail Film</title>
		<meta charset="utf-8">
		<base href="../">
		<meta name="author" content="L.Merino et V.Lefevre">
		<meta name='copyright' content='L.Merino et V.Lefevre'>
		<meta name="keywords" content="SAE203, Bases de données, Intégration Web, Développement Web, Hébergement">
		<meta name='date' content='Apr. 27, 2022'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/sae203.css">
		<link rel="stylesheet" type="text/css" href="css/affich-detail.css">
		<script type="text/javascript" src="js/sae203.js"></script>
		<script type="text/javascript">
			
			// compléter avec le code local au fichier
			addEventListener('DOMContentLoaded',function(){
			
				document.getElementById('source').value = 'page2';

			});

		</script>
	</head>
	<body>
		<header> <!-- commun à toute les pages sauf les chemins -->
			<nav>
				<ul>
					<li><a href="affichage/genres.php">&#9664;&ensp;Retour aux genres</a></li>
				</ul>
			</nav>
		</header>
		<main>
			<h1 class="visible">Affichage > Genre > Détail Film</h1>
			<section>
				<form action="affichage/genres.php" method="POST">
					<input id="source" type="hidden" name="source" value="page2">
                <?php
				extract($_POST);
                
				$tab = ['selectFilm' => 'Intitulé', 'selectGenre' => 'Genre', 'realis' => 'Réalisateur'];

				include("../db/connexion.php");
                try {
                    $sql = "SELECT f.nom, f.genre, CONCAT(r.prenom, ' ', r.nom) Réalisateur FROM FILM as f INNER JOIN REALISATEUR r ON f.idreal = r.idreal WHERE visa = '$selectFilm'";
                    $stmt=$dtb->prepare($sql);
					$stmt->execute();

                    while ($ligne = $stmt->fetch(PDO::FETCH_NUM)) {
						for ($i = 0; $i < count($tab); $i++) {
							$k = array_keys($tab)[$i];
							$v = $tab[$k];
							$value = $ligne[$i];
							echo "<label for='$k'>$v</label><input type='text' name='$k' value='$value' readonly>";
						}
					}

                } catch (PDOException $e) {
                    echo "Erreur :".$e -> getMessage()."<br/>";
                    exit(0);
                }
                ?>
				<input type="submit" name="retour" value="Retour aux genres">
				</form>
			</section>
		</main>
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