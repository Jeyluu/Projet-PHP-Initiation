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
        
            <a href="article.php?id=<?= $article["id"]?> " class="lienArticle"><h3><?= strip_tags($article["nom"]) ?></h3>
            <p><?= strip_tags($article["contenu"]) ?></p>
            <p class="dateArticle">Article posté le : <?= strip_tags($article["DateCreation"]) ?></p></a>
        
    </article>

<?php
//endforeach permet de fermer la boucle
endforeach;
?>
</section>




<?php
    include("Common/footer.php");
?>