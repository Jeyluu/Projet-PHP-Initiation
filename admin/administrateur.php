<?php

    //Je me connecte à la base de donnée
    //On va chercher les articles dans la base de données
    require_once("../Common/connexionbdd.php");

    //On fait la requête pour aller chercher les 
    $sql = "SELECT * FROM `article` INNER JOIN visiteurs  ON visiteur = visiteurs.identifiant";

    //On execute la requete
    $requete = $db->query($sql);


    //On recupère les données FetchALL
    $articles = $requete->fetchAll();


    $title = "Espace administrateur";

    include("../Common/admin-header.php");
    include("../Common/navigation.php");
?>
<h2>Bienvenue sur l'espace Administrateur</h2>
<a href="articles/ajout.php"><input type="button" value="Ajouter un article"></a>


<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>Titre de l'article</td>
                <td>Prénom de l'auteur</td>
                <td>Nom de l'auteur</td>
                <td>Date</td>
                <td>Modifier l'article</td>
                <td>Suppression de l'article</td>
            </tr>
        </thead>

        <tbody>
        <?php foreach($articles as $article): ?>
            <tr>
                <td><?= strip_tags($article["titre"])?></td>
                <td><?= strip_tags($article["prenom"])?></td>
                <td><?= strip_tags($article["nom"])?></td>
                <td><?= strip_tags($article["DateCreation"])?></td>
                <td><a href="articles/modification.php"><input type="button" value="Modifier"></a></td>
                <td><a href=""><input type="button" value="Supprimer"></a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php
    include("../Common/admin-footer.php");
?>