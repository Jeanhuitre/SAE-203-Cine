<?php
        $dsn="mysql:host=mysql.info.unicaen.fr;dbname=merino221_4";
        $user="merino221";
        $mdp="eequa4yaHei1ooph";

        try {
            $dtb=new PDO($dsn,$user,$mdp);
            $dtb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "ERREUR : ".$e->getMessage()."<br>";
            die();
        }
    ?>