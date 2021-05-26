<?php
$title = "Inscription";

    //Vérification de l'envoi du formulaire
    if(!empty($_POST)){
        //Formulaire envoyé donc on vérifie que tous les champs sont remplis
        if(isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["motdepasse"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["motdepasse"])){

            //Formulaire Complet
            //On récupère les données en les protégeant
            $nom = strip_tags($_POST["nom"]);

            //Vérifier si l'Email est réellement un Email
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                die ("La donnée dans le champs adresse Email ne correspond pas.");
            }
            //Hasher le mot de passe
            $pass = password_hash($_POST["motdepasse"], PASSWORD_ARGON2ID);
            
            //Enregistrement en base de donnée
            require_once("Common/connexionbdd.php");

            $sql = "INSERT INTO `visiteurs` (`nom`,`prenom`,`email`,`motdepasse`) VALUES (:nom, :prenom, :email, '$pass')";

            //Préparation de la requête
            $requete = $db->prepare($sql);
            
            $requete->bindValue(":nom",$nom, PDO::PARAM_STR);
            $requete->bindValue(":prenom",$_POST["prenom"], PDO::PARAM_STR);
            $requete->bindValue(":email",$_POST["email"], PDO::PARAM_STR);

            
            //On lance la requête
            $requete->execute();


        }else{
            die ("Le formulaire n'est pas complet.");
        }
    }

    
    include("Common/header.php");
    include("Common/navigation.php");
    
?>
<h2>Formulaire d'inscription</h2>
<section>
    <form method="POST">
        <div>
            <label for="nom">Nom</label><br>
            <input type="text" name="nom" id="nom">
        </div><br>
        <div>
            <label for="prenom">Prénom</label><br>
            <input type="text" name="prenom" id="prenom">
        </div>
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="motdepasse">Mot de passe</label><br>
            <input type="password" name="motdepasse" id="motdepasse">
        </div>
        <button type="submit">M'inscrire</button>
    </form>
</section>




<?php
    include("Common/footer.php");
?>