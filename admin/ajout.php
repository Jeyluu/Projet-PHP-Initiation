<?php
    //Je me connecte à la base de donnée
    //On va chercher les articles dans la base de données
    require_once("../Common/connexionbdd.php");

    //On fait la requête pour aller chercher les 
    $sql = "SELECT *  FROM `visiteurs`";

    //On execute la requete
    $requete = $db->query($sql);


    //On recupère les données FetchALL
    $visiteurs = $requete->fetchAll();

//On traite le formulaire
if(!empty($_POST)){
    //POST n'est pas vide, on vérifie que toutes les données soient présentes
    if(
        isset($_POST["titre"], $_POST["contenu"],$_POST["visiteur"]) &&
        !empty($_POST["titre"]) && !empty($_POST["contenu"]) && !empty($_POST["visiteur"])
    ){
        //Le formulaire est complet
        //On récupère les données  en les protégeant pour les failles XSS
        //On retire toute balise du titre
        $nom = strip_tags($_POST["titre"]);
        $visiteur = strip_tags($_POST["visiteur"]);
        var_dump($visiteur);
        //On neutralise toute balise du contenu
        $contenu = htmlspecialchars($_POST["contenu"]);

        //On peut les enregistrer
        //On se connecte à la base
        require_once "../Common/connexionbdd.php";

        //On écrit la requête 
        $sql = "INSERT INTO `article` (titre,contenu,visiteur) VALUES (:titre, :contenu,:visiteur)";

        //On prépare la requete
        $requete = $db->prepare($sql);

        //On injecte les valeurs
        $requete->bindValue(":titre", $nom, PDO::PARAM_STR);
        $requete->bindValue(":contenu", $contenu, PDO::PARAM_STR);
        $requete->bindValue(":visiteur", $visiteur, PDO::PARAM_INT);

        
        //On execute la requete
        if(!$requete->execute()){
            die("Une erreur est survenue");
        }

        //On recupere l'Id de l'article
        $id = $db->lastInsertId();
        header('Location: administrateur.php');   


    } else {
        die("Le formulaire que vous venez d'enregistrer n'est pas complet.<br> Merci de réessayer !");
    }
}

$title = "Ajouter un article";

    include_once "../Common/admin-header.php";
    include_once "../Common/navigation.php";

?>
<h2>Ajouter un article au forum</h2>
<form method="POST">
    <fieldset>

        <div>
            <label for="titreArticle">Nom de l'article</label><br>
            <input type="text" name="titre" placeholder="Saissisez ici le titre" ><br>
        </div>
        
        <div>
            <label for="contenuArticle">Contenu de l'article</label><br>
            <textarea name="contenu" id="contenu" cols="100" rows="10"></textarea><br>
        </div>

        <div>
            <label for="contenuArticle">Auteur</label><br>
            <select name="visiteur" id="visiteur">
                <option>Qui est l'auteur</option>
                <?php foreach($visiteurs as $visiteur):?>
                <option value="<?= $visiteur["identifiant"] ?>"><?= $visiteur["prenom"] . " " . $visiteur["nom"] ?></option>
                <?php endforeach; ?>

            </select><br>
        </div><br>

        <button type="submit">Enregister</button>

    </fieldset>
</form>

<?php

    include_once "../Common/footer.php";

?>