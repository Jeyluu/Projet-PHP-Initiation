<?php
$title = "Les mises à jours";

    
    include("Common/header.php");
    include("Common/navigation.php");

//On va chercher les articles dans la base de données
require_once("Common/connexionbdd.php");
//On ecrit la requête
$sql = "SELECT * FROM `article` ORDER BY `dateCreation` DESC";

//On execute la requête
$requete = $db->query($sql);

//On récupère les données FetchALL = aller tous chercher
$articles = $requete->fetchAll();


?>

    <h2 style="text-align: center;">Historique des mises à jours faites</h2>
    

<section class="articles">

<?php foreach($articles as $article):?>

    <article class="conteneurArticle">
        
            <h3><a href="article.php?id=<?= $article["id"]?>"><?= strip_tags($article["nom"]) ?></a></h3>
            <p><?= strip_tags($article["contenu"]) ?></p>
            <p class="dateArticle">Article posté le : <?= strip_tags($article["DateCreation"]) ?></p>
        
    </article>

<?php
//endforeach permet de fermer la boucle
endforeach;
?>
</section>




<?php
    include("Common/footer.php");
?>