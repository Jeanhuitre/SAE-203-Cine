<?php

    include('../db/connexion.php');
    extract($_POST); 

    // Préparer et exécuter la requête d'insertion
    try {
        $sql = "INSERT INTO SALLE (nusalle, capacite)
                VALUES ('$nusalle', '$capacite')";
        $res = $dtb->prepare($sql);
        $res->bindParam(':nusalle', $nusalle); /* on utilise bindPram en plus de prepare afin de traîter les données comme des données et non des requêtes */
        $res->bindParam(':capacite', $capacite);
        $res->execute();

        $GLOBALS['confirm'] = "La salle a bien été crée.";
    } catch (PDOException $e) {
        echo "ERREUR : " . $e->getMessage() . "<br>";
        exit(0);
    }

    include('salles.php');
    exit; // Assurez-vous de terminer le script après la redirection
?>