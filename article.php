<?php
//Verif si ID présent
if(!isset($_GET["id"]) || empty($_GET["id"])){
    //Je n'ai pas d'ID
    header('Location: articles.php');
    exit;

}

//Je récupère l'ID
$id = $_GET["id"];

//On va chercher les articles dans la base de données
require_once("Common/connexionbdd.php");

// On va chercher l'article dans la base
//On écrit la requete
$sql = "SELECT * FROM `article` WHERE `id` = :id";

//On prépare la requete
$requete = $db->prepare($sql);

//On injecte les paramètres
$requete->bindValue(":id", $id, PDO::PARAM_INT);

//On execute la requete
$requete->execute();

//On récupère l'article
$article = $requete->fetch();

//On vérifie si l'article est vide
if(!$article){
    http_response_code(404);
    echo "L'article est innexistant.";
    exit;
}

//Ici on a un article
//On défini le titre
$title = strip_tags($article["nom"]);


    include("Common/header.php");
    include("Common/navigation.php");

?>

<section class="articles">



    <article class="conteneurArticle">
        
            <h3><?= strip_tags($article["titre"]) ?></h3>
            <p><?= strip_tags($article["contenu"]) ?></p>
            <p class="dateArticle">Article posté le : <?= strip_tags($article["DateCreation"]) ?></p>
        
    </article>


</section>
