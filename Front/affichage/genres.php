<?php
extract($_POST);

if (isset($selectGenre) && $selectGenre != null) {
	$a = true;
} else $a = false;

if(isset($source)) {
if ($source == 'page2') {
	$b = 'page2';
} else {
	$b = 'page1';
}
var_dump($b);
}

var_dump($a);

?>
<!DOCTYPE html>
<html lang='fr'>
	<head> <!-- commun à toute les pages sauf title dépend de la page -->
		<title>SAE203 - Affichage - Genres</title>
		<meta charset="utf-8">
		<base href="../">
		<meta name="author" content="L.Merino et V.Lefevre">
		<meta name='copyright' content='L.Merino et V.Lefevre'>
		<meta name="keywords" content="SAE203, Bases de données, Intégration Web, Développement Web, Hébergement">
		<meta name='date' content='2022-04-27'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/sae203.css">
		<link rel="stylesheet" type="text/css" href="css/affich-genres.css">
		<script type="text/javascript" src="js/sae203.js"></script>
		<script type="text/javascript" src="js/genres.js"></script>
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
					<li><a href="#" class="rubrique selected">Affichage</a>
						<ul>
							<li><a href="affichage/films.php">Films</a></li>
							<li><a href="affichage/realis.php">Réalisateurs</a></li>
							<li><a href="affichage/salles.php">Salles</a></li>
							<li><a href="affichage/horaires.php">Horaires</a></li>
                            <li><a class="selected" href="affichage/genres.php">Genres</a></li>
						</ul>
					</li>
					<li><a href="#" class="rubrique">Insertion</a>
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
			<div id="B" style="display: none;"><?php echo $b; ?></div>
			<h1 class="visible">Affichage > Genres</h1>
			<section>
                <form action="affichage/detail-film.php" method="POST">
					<input id="source" type="hidden" name="source" value="page1">
					<label for="selectGenre" class="invisible">Genre</label>
					<select name="selectGenre" id="selectGenre">
                    <?php
					if ($a == false) {
						echo "<option value='defaut' disabled='disabled' selected='selected'>Sélectionnez un genre</option>";
					} elseif ($a == true) {echo "<option value='defaut' disabled='disabled'>Sélectionnez un genre</option>";}
                    include ("../db/connexion.php");
                    try {
                        $sql="SELECT genre from FILM group by genre order by genre";
                        $stmt=$dtb->prepare($sql);
                        $stmt->execute();
                        while ($ligne=$stmt->fetch(PDO::FETCH_ASSOC)) {
							if ($ligne["genre"] == $selectGenre) {
								echo "<option selected='selected' value='".$ligne["genre"]."'>".$ligne["genre"]."</option>";
							} else {
								echo "<option value='".$ligne["genre"]."'>".$ligne["genre"]."</option>";
							}
                        }
                    } catch (PDOException $e) {
                        echo "ERREUR : ".$e->getMessage()."<br>";
                        exit(0);
                    }
                    ?>
					</select>

					<select name="selectFilm" id="selectFilm">
					<?php
					if ($a == false) {
						echo "<option value='defaut' disabled='disabled' selected='selected'>Sélectionnez un film</option>";
					} elseif ($a == true) {echo "<option value='defaut' disabled='disabled'>Sélectionnez un film</option>";}
						try {
							$sql = "SELECT f.visa, f.nom from FILM f inner join REALISATEUR r on f.idreal = r.idreal where genre = '$selectGenre'";
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
                    <input type="submit" value="Détail">
					<p></p>
                </form>
			</section>
		</main>
		<footer> <!-- le même pour toutes les pages -->
			<div id="listpages">
				<a href="index.php">Accueil</a><br>
				<span class='selected'>Affichage</span> > <a href="affichage/films.php">Films</a>, <a href="affichage/realis.php">Réalisateurs</a>, <a href="affichage/salles.php">Salles</a>, <a href="affichage/horaires.php">Horaires</a>, <a class='selected' href="affichage/genres.php">Genres</a><br>
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