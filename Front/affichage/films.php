<!DOCTYPE html>
<html lang="fr">
	<head> <!-- commun à toute les pages sauf title dépend de la page -->
		<title>SAE203 - Affichage - Films</title>
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
		<script>
			
		</script>

	</head>
	<body>
		<header> <!-- commun à toute les pages sauf les chemins -->
			<nav>
				<ul>
					<li><a href="index.html">SAE 203</a></li>
					<li><a href="" class="rubrique selected">Affichage</a>
						<ul>
							<li><a class="selected" href="affichage/films.html">Films</a></li>
							<li><a href="affichage/realis.html">Réalisateurs</a></li>
							<li><a href="affichage/salles.html">Salles</a></li>
						</ul>
					</li>
					<li><a href="" class="rubrique">Insertion</a>
						<ul>
							<li><a href="insertion/films.html">Films</a></li>
							<li><a href="insertion/salles.html">Salles</a></li>
							<li><a href="insertion/proj.html">Projections</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</header>
		<main>
			<h1 class="visible">Affichage > Films</h1>
			<section class="tableau">
				<table id="table">

					<?php 
						include ("");
						try {
							$sql="Select f.nom, f.duree, f.genre, idreal, nom, jour from FILLM
							f inner join REALISATEUR as r on f.idreal = r.idreal INNER JOIN 
							PROJECTION as p on f.visa = p.visa GROUP BY f.visa";
							$res=$dtb->query($sql);
							echo "<thead>
									<td>Titre</td>
									<td>Realisateur</td>
									<td>Genre</td>
									<td>Durée</td>
									<td>Année</td>
									</thead>
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

					<!--<thead>
						<td>Titre</td>
						<td>Réalisateur</td>
						<td>Genres</td>
						<td>Durée</td>
						<td>Année</td>
					</thead>
					<tbody>
						<tr>
							<td>Film1</td>
							<td>Real1</td>
							<td>Policier</td>
							<td>1h45</td>
							<td>2020</td>
						</tr>
						<tr>
							<td>Film2</td>
							<td>Real2</td>
							<td>Fantastique</td>
							<td>2h10</td>
							<td>2022</td>
						</tr>
						<tr>
							<td>Film3</td>
							<td>Real3</td>
							<td>Drame</td>
							<td>2h45</td>
							<td>2021</td>
						</tr>
						<tr>
							<td>Film4</td>
							<td>Real4</td>
							<td>Drame</td>
							<td>2h04</td>
							<td>2022</td>
						</tr>
						<tr>
							<td>Film5</td>
							<td>Real5</td>
							<td>Fantastique</td>
							<td>2h10</td>
							<td>2021</td>
						</tr>
						<tr>
							<td>Film6</td>
							<td>Real6</td>
							<td>Drame</td>
							<td>1h40</td>
							<td>2022</td>
						</tr>
					</tbody>-->
				</table>
			</section>
		</main>
		<footer> <!-- le même pour toutes les pages -->
			<div id="listpages">
				<a href="index.html">Accueil</a><br>
				<span class='selected'>Affichage</span> > <a href="affichage/films.php" class='selected'>Films</a>, <a href="affichage/realis.html">Réalisateurs</a>, <a href="affichage/salles.html">Salles</a><br>
				<span>Insertion</span> > <a href="insertion/films.html">Films</a>, <a href="insertion/salles.html">Salles</a>, <a href="insertion/proj.html">Projections</a>
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