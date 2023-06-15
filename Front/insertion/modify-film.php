<?php 

    include('../db/connexion.php');
    extract($_POST); 

    $nom_echappe = addslashes($nom);
    $synopsis_echappe = addslashes($synopsis);

    try {
        $sql = "UPDATE FILM
            SET nom = :nom, 
                idreal = :rea,
                genre = :genre,
                synopsis = :synopsis
            WHERE visa = :selectFilm";

        $res = $dtb->prepare($sql);
        $res->bindParam(':nom', $nom);
        $res->bindParam(':rea', $rea);
        $res->bindParam(':genre', $genre);
        $res->bindParam(':synopsis', $synopsis);
        $res->bindParam(':selectFilm', $selectFilm);
        $res->execute();
        $GLOBALS['confirm'] = "Le film a bien été modifié.";
    } catch (PDOException $e) {
        echo "ERREUR : " . $e->getMessage() . "<br>";
        exit(0);
    }

    include('films.php');
    exit; // Assurez-vous de terminer le script après la redirection


?>