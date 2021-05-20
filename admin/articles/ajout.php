<?php

//On traite le formulaire
if(!empty($_POST)){
    //POST n'est pas vide, on vérifie que toutes les données soient présentes
    if(
        isset($_POST["nom"], $_POST["contenu"]) &&
        !empty($_POST["nom"]) && !empty($_POST["contenu"])
    ){
        //Le formulaire est complet
        //On récupère les données  en les protégeant pour les failles XSS
        //On retire toute balise du titre
        $nom = strip_tags($_POST["nom"]);

        //On neutralise toute balise du contenu
        $contenu = htmlspecialchars($_POST["contenu"]);

        //On peut les enregistrer
        //On se connecte à la base
        require_once "../../Common/connexionbdd.php";

        //On écrit la requête 
        $sql = "INSERT INTO `article` (nom,contenu,visiteur) VALUES (:nom, :contenu,:visiteur)";

        //On prépare la requete
        $query = $db->prepare($sql);

        //On injecte les valeurs
        $query->bindValue(":nom", $nom, PDO::PARAM_STR);
        $query->bindValue(":contenu", $contenu, PDO::PARAM_STR);
        $query->bindValue(":visiteur", $visiteur, PDO::PARAM_INT);

        
        //On execute la requete
        if(!$query->execute()){
            die("Une erreur est survenue");
        }

        //On recupere l'Id de l'article
        $id = $db->lastInsertId();
    
        die("L'article a été ajouté avec le numéro $id");


    } else {
        die("Le formulaire que vous venez d'enregistrer n'est pas complet.<br> Merci de réessayer !");
    }
}

$title = "Ajouter un article";

    include_once "../../Common/admin-header.php";
    include_once "../../Common/navigation.php";

?>
<h2>Ajouter un article au forum</h2>
<form action="#" method="POST">
    <fieldset>

        <div>
            <label for="titreArticle">Nom de l'article</label><br>
            <input type="text" name="nom" placeholder="Saissisez ici le titre" ><br>
        </div>
        
        <div>
            <label for="contenuArticle">Contenu de l'article</label><br>
            <textarea name="contenu" id="contenu" cols="100" rows="10"></textarea><br>
        </div>

        <button type="submit">Enregister</button>

    </fieldset>
</form>

<?php

    include_once "../../Common/footer.php";

?>