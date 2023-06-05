<!DOCTYPE html>
<html lang="fr">
	<head> <!-- commun à toute les pages sauf title dépend de la page -->
		<title>SAE203 - Affichage - Réalisateurs</title>
		<meta charset="utf-8">
		<base href="../">
		<meta name="author" content="L.Merino et V.Lefevre">
		<meta name='copyright' content='L.Merino et V.Lefevre'>
		<meta name="keywords" content="SAE203, Bases de données, Intégration Web, Développement Web, Hébergement">
		<meta name='date' content='Apr. 27, 2022'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/sae203.css">
		<link rel="stylesheet" type="text/css" href="css/affich-tab.css">
		<script type="text/javascript" src="js/sae203.js"></script>
		<script type="text/javascript" src="js/tableaux.js"></script>
		<script type="text/javascript">
			
			// compléter avec le code local au fichier
			addEventListener('DOMContentLoaded',function(){

				// appel pour mise en place des écouteur sur les colonnes du tableau
				let tableau = document.querySelector('body>main>section>table');
				trier(tableau);

				// appel pour la recherche
				preparerRecherche(
					document.querySelector('#monSelect'), 
					document.querySelector('#monInputRech'),
					document.querySelector('#btnReset'),
					tableau
				);
			});

		</script>
	</head>
	<body>
		<header> <!-- commun à toute les pages sauf les chemins -->
			<nav>
				<ul>
					<li><a href="index.php">SAE 203</a></li>
					<li><a href="" class="rubrique selected">Affichage</a>
						<ul>
							<li><a href="affichage/films.php">Films</a></li>
							<li><a class="selected" href="affichage/realis.php">Réalisateurs</a></li>
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
			<h1 class="visible">Affichage > Réalisateurs</h1>
			<section class="tableau">
				<form>
					<input type="text" id="monInputRech" placeholder="Rechercher ..."><select id="monSelect"></select><button type="button" id="btnReset">Effacer</button>
				</form>
				<table>
					<?php 
						include ("../db/connexion.php");
						try {
							$sql="Select concat(r.nom, ' ', r.prenom) from REALISATEUR as r Group by r.idreal";
							$res = $dtb->prepare($sql);
    						$res->execute();
							echo "<thead><tr>
									<th>Liste des réalisateurs</th>
									</tr></thead>
									<tbody>
									\n";
							while ($ligne=$res->fetch(PDO::FETCH_OBJ)) {
								echo "<tr>";
								foreach ($ligne as $elt)
									echo "<td>".$elt."</td>";
								echo "<tr>\n";
							}
							echo "</tbody>";
						} catch (PDOException $e) {
							echo "ERREUR : ".$e->getMessage()."<br>";
							exit(0);
						}
						?>
				</table>
			</section>
		</main>
		<footer> <!-- le même pour toutes les pages -->
		<div id="listpages">
				<a href="index.php">Accueil</a><br>
				<span class='selected'>Affichage</span> > <a href="affichage/films.php">Films</a>, <a href="affichage/realis.php" class='selected'>Réalisateurs</a>, <a href="affichage/salles.php">Salles</a>, <a href="affichage/horaires.php">Horaires</a>, <a href="affichage/genres.php">Genres</a><br>
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