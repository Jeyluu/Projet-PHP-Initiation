<?php
//Verif si ID présent
if(!isset($_GET["id"]) || empty($_GET["id"])){
    //Je n'ai pas d'ID
    header('Location: articles.php');
    exit;

}


//On va chercher les articles dans la base de données
require_once("Common/connexionbdd.php");


    include("Common/header.php");
    include("Common/navigation.php");

?>

<section class="articles">



    <article class="conteneurArticle">
        
            <h3><a href="article.php?id=<?= $article["id"]?>"><?= strip_tags($article["nom"]) ?></a></h3>
            <p><?= strip_tags($article["contenu"]) ?></p>
            <p class="dateArticle">Article posté le : <?= strip_tags($article["DateCreation"]) ?></p>
        
    </article>


</section>
