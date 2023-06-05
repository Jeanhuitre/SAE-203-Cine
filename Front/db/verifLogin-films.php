<?php 
session_start();

if (isset($_POST['login']) && $_POST['login'] != "") { /* Vérifie si Login existe et s'il n'est pas vide */

    include("connexion.php");

    extract($_POST);

    try {
        $sql = "SELECT login, mdp from ADMIN
        where login = '$login' and mdp = '$mdp'";
        $res = $dtb->prepare($sql);
        $res->bindParam(':login', $login); /* on utilise bindPram en plus de prepare afin de traîter les données comme des données et non des requêtes */
        $res->bindParam(':mdp', $mdp);
        $res->execute();
        if ($res->fetchColumn()) {
            $_SESSION['logged_in'] = true;
            $_SESSION['login'] = $_POST['login'];
            header('Location: ../insertion/films.php'); // Redirection vers la page des films
            exit();
        } else {
            // Login ou mot de passe incorrect, renvoie au formulaire de connexion avec un message d'erreur
            $msgErreurSaisie = "Login ou mot de passe incorrect";
            include("../db/auth-films.php");
        }
    } catch (PDOException $e) {  // Capture l'erreur dans $e
        echo "Erreur : " . $e->getMessage();
        die();
    }
} else {
    // Login ou mot de passe non soumis, renvoie au formulaire de connexion
    include("../db/auth-films.php");
}
?>
