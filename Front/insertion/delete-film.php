<?php

    include('../db/connexion.php');
    extract($_POST); 

    // Préparer et exécuter la requête d'insertion
            try {
                $sql = "DELETE FROM FILM WHERE visa = $selectFilm";
                $res = $dtb->prepare($sql);
                $res->bindParam(':visa', $visa);
                $res->execute();

                $sql = "DELETE FROM PROJECTION WHERE visa = $selectFilm";
                $res = $dtb->prepare($sql);
                $res->bindParam(':visa', $visa);
                $res->execute();

                
                $GLOBALS['confirm'] = "Le film a été supprimé avec succès.";
            } catch (PDOException $e) {
                echo "ERREUR : " . $e->getMessage() . "<br>";
                exit(0);
            }

            include('films.php');
            exit; // Assurez-vous de terminer le script après la redirection
?>