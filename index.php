<?php
$title = "Accueil";
//On démarre la session PHP
session_start();
    require_once("Common/fonctions.php");
    include("Common/header.php");
    include("Common/navigation.php");
?>

    <img src="ressources/images/banniere.jpg" alt="banniereProjetMMORPG">



<?php
    require_once("Common/connexionbdd.php");
    require_once("Common/requetepreparee.php");

    include("Common/footer.php");
?>