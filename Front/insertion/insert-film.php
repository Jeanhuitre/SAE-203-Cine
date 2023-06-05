<?php

    include('../db/connexion.php');
    extract($_POST); 

    // Préparer et exécuter la requête d'insertion

    $nom_echappe = addslashes($nom);
    $synopsis_echappe = addslashes($synopsis);

    try {
        $sql = "INSERT INTO FILM (nom, visa, duree, idreal, genre, synopsis)
                VALUES ('$nom_echappe', '$visa', '$duree', '$rea', '$genre', '$synopsis_echappe')";
        $res = $dtb->prepare($sql);
        $res->bindParam(':nom', $nom); /* on utilise bindPram en plus de prepare afin de traîter les données comme des données et non des requêtes */
        $res->bindParam(':visa', $visa);
        $res->bindParam(':duree', $duree);
        $res->bindParam(':rea', $rea);
        $res->bindParam(':genre', $genre);
        $res->bindParam(':synopsis', $synopsis);
        $res->execute();
        $GLOBALS['confirm'] = "Le film a bien été inséré. Ajoutez lui une salle et une projection pour finaliser l'affichage en ligne.";
    } catch (PDOException $e) {
        echo "ERREUR : " . $e->getMessage() . "<br>";
        exit(0);
    }

    include('films.php');
    exit; // Assurez-vous de terminer le script après la redirection
?>
