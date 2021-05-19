<?php
include("Common/header.php");
include("Common/navigation.php");
?>

    <img src="ressources/images/banniere.jpg" alt="banniereProjetMMORPG">

<div class="introduction">
    <h1>Test d'application</h1>
    
    <h2>Notre volonté</h2>
    <p class="intro-presentation">
        Voici un petite introduction au nouveau MMORPG qui sortira le 1er Janvier 2023. Faire de notre jeu une référence dans le MMORPG.<br>
        Pour y arriver nous aurons besoin de vous, dans une démarche d'amélioration du jeu avoir vos retours sur les graphiques , l'économie et tout les autres points du jeu.
        Ensemble, nous deviendrons plus fort !
    </p>
</div>

<?php

    //Constante d'envirronnement
    define("DBHOST","localhost");
    define("DBUSER","root");
    define("DBPASS","");
    define("DBNAME","projet mmorpg");

    //Data Source Name de connexion
    $dsn = "mysql:dbname=". DBNAME .";host=". DBHOST;
    

    //Connexion à la base de données
    try{
        //On instancie PDO
        $db = new PDO($dsn, DBUSER,DBPASS);
        
        //On s'assure d'envoi des données UTF-8
        $db->exec("SET NAMES utf-8");

    }catch(PDOException $e){
        die("Erreur:". $e->getMessage());
    }

    //Ici il est connectés à la base
    //On peut récupérer la liste des utilisateurs(visiteurs)
    $sql = "SELECT * FROM `visiteurs`";

    //On execute directement la requête
    $requete = $db->query($sql);

    //On récupère les données (fetch ou fetch all)

    $visiteur = $requete->fetch(PDO::FETCH_ASSOC);
    echo "<pre>";
    var_dump($visiteur);
    echo "</pre>";
?>

<?php
include("Common/footer.php");
?>