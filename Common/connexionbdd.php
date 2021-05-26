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

        //On définit le mode de "Fetch" envoyé par défaut
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        die("Erreur:". $e->getMessage());
    }

    // //Ici il est connectés à la base
    // //On peut récupérer la liste des utilisateurs(visiteurs)
    // $sql = "SELECT * FROM `visiteurs`";

    // //On execute directement la requête
    // $requete = $db->query($sql);

    // //On récupère les données (fetch ou fetch all)

    // $visiteur = $requete->fetchAll();
    
    // //Ajouter un utilisateur
    // $sql = "INSERT INTO `visiteurs` (`nom`,`prenom`,`email`,`motdepasse`) VALUES ('Supprimer','Pauline','supprimer@gmail.com','test')";
    // $requete = $db->query($sql);

    // //Modifier un utilisateur
    // $sql = "UPDATE `visiteurs` SET `motdepasse` = 'test' WHERE `identifiant` = 3";

    // //supprimer un utilisateur
    // $sql = "DELETE FROM `visiteurs` WHERE `identifiant` > 3";
    // $requete = $db->query($sql);
    

    // //Savoir combien de lignes ont été supprimées
    // // echo $requete->rowCount();

?>