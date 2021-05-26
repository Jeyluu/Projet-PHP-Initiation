<?php
/* ****************************  Reprise de données **************************** */
//Verif si ID présent
if(!isset($_GET["id"]) || empty($_GET["id"])){
    //Je n'ai pas d'ID
    header('Location: administrateur.php');
    exit;

}
//Je récupère l'ID
$id = $_GET["id"];


//On va chercher les articles dans la base de données
require_once("../Common/connexionbdd.php");

// On va chercher l'article dans la base
//On écrit la requete
$sql = "SELECT * FROM `article` INNER JOIN visiteurs  ON visiteur = visiteurs.identifiant WHERE `id` = :id";


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

/* ****************************  Modification de données **************************** */

//On traite le formulaire
if(!empty($_POST)){
    //POST n'est pas vide, on vérifie que toutes les données soient présentes
    if(
        isset($_POST["titre"], $_POST["contenu"], $_POST["id"]) &&
        !empty($_POST["titre"]) && !empty($_POST["contenu"]) && !empty($_POST["id"])
    ){
        //Le formulaire est complet
        //On récupère les données  en les protégeant pour les failles XSS
        //On retire toute balise du titre
        $titre = strip_tags($_POST["titre"]);
        
        

        //On neutralise toute balise du contenu
        $contenu = htmlspecialchars($_POST["contenu"]);


        //On écrit la requête 
        $sql = "UPDATE `article`  SET titre = :titre, contenu = :contenu WHERE id = :id ";

        //On prépare la requete
        $requete = $db->prepare($sql);


        //On injecte les valeurs
        $requete->bindValue(":titre", $titre, PDO::PARAM_STR);
        $requete->bindValue(":contenu", $contenu, PDO::PARAM_STR);
        $requete->bindValue(":id", $id, PDO::PARAM_INT);

        
        //On execute la requete
        $requete->execute();

        header("Location: administrateur.php");
        


    } else {
        die("Le formulaire que vous venez d'enregistrer n'est pas complet.<br> Merci de réessayer !");
    }
}



$title = "Modifier un article";

    include_once "../Common/admin-header.php";
    include_once "../Common/admin-navigation.php";

?>


<h2>Modifier un article au forum</h2>
<form method="POST">
    <fieldset>

        <div>
            <label for="titreArticle">Nom de l'article</label><br>
            <input type="hidden" name="id"  value="<?= $article["id"]?>">
            <input type="text" name="titre" value="<?= strip_tags($article["titre"])?>"><br>
        </div><br>
        
        <div>
            <label for="contenuArticle">Contenu de l'article</label><br>
            <textarea name="contenu" id="contenu" cols="100" rows="10"><?= strip_tags($article["contenu"])?></textarea><br>
        </div><br>

        <button type="submit">Enregister</button>

    </fieldset>
</form>

<?php

    include_once "../Common/footer.php";

?>