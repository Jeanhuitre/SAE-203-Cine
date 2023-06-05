<?php

    include('../db/connexion.php');
    extract($_POST); 

    // Préparer et exécuter la requête d'insertion
    try {
        
        $sql = "SELECT duree from FILM where visa = $visa";
        $res = $dtb->prepare($sql);
        $res->bindParam(':visa', $visa); /* on utilise bindPram en plus de prepare afin de traîter les données comme des données et non des requêtes */
    	$res->execute();

        $row = $res->fetch(PDO::FETCH_ASSOC);
        $dureeFilm = $row['duree']; /* stock la durée du film dans une variable */
        
        list($heureDebutHeures, $heureDebutMinutes) = explode(':', $dureeDeb);
        $heureDebut = $heureDebutHeures * 3600 + $heureDebutMinutes * 60;
        
        // Convertir la durée du film en secondes
        list($dureeFilmHeures, $dureeFilmMinutes) = explode(':', $dureeFilm);
        $dureeFilm = $dureeFilmHeures * 3600 + $dureeFilmMinutes * 60;
        
        // Calculer l'heure de fin en ajoutant la durée du film à l'heure de début
        $heureFin = $heureDebut + $dureeFilm;
        
        // Convertir l'heure de fin en format HH:MM
        $heureFinHeures = floor($heureFin / 3600);
        $heureFinMinutes = floor(($heureFin - $heureFinHeures * 3600) / 60);
        $heureFin = sprintf('%02d:%02d', $heureFinHeures, $heureFinMinutes);

        $sql = "INSERT INTO PROJECTION (visa, nusalle, date, heure_debut, heure_fin)
                VALUES ('$visa', '$salle', '$date', '$dureeDeb', '$heureFin')";
        $res = $dtb->prepare($sql);
        $res->bindParam(':visa', $visa);
        $res->bindParam(':salle', $salle);
        $res->bindParam(':date', $date);
        $res->bindParam(':dureeDeb', $dureeDeb);
        $res->bindParam(':heureFin', $heureFin);
        $res->execute();

        $GLOBALS['confirm'] = "La projection a bien été planifiée";
    } catch (PDOException $e) {
        echo "ERREUR : " . $e->getMessage() . "<br>";
        exit(0);
    }

    include('proj.php');
    
    exit; // Assurez-vous de terminer le script après la redirection
?>
