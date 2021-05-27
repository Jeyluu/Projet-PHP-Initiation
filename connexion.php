<?php
$title = "Connexion";
            //On démarre la session PHP
            session_start();
            if(isset($_SESSION["visiteur"])){
                header("Location: index.php");
                exit;
            }
    //Vérification de l'envoi du formulaire
    if(!empty($_POST)){
        //Formulaire envoyé donc on vérifie que tous les champs sont remplis
        if(isset($_POST['email'], $_POST['motdepasse']) && !empty($_POST['email'] && !empty($_POST['motdepasse']))){
            //Vérifier si l'Email est réellement un Email
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                die("Ce n'est pas un email");
            }
            //Connexion à la base de données
                require_once "Common/connexionbdd.php";

            //La requête
            $sql = "SELECT * FROM `visiteurs` WHERE `email` = :email";
            $requete = $db->prepare($sql);
            $requete->bindValue(":email", $_POST['email'], PDO::PARAM_STR);
            $requete->execute();

            $visiteur = $requete->fetch();
                // var_dump($visiteur);
            if(!$visiteur){
                die ("L'utilisateur et/ou le mot de passe n'existe pas !");
            }
            //Ici on a un visiteur existant, on peut vérifier le mot de passe
            if(!password_verify($_POST['motdepasse'],$visiteur['motdepasse'])){
                die("L'utilisateur et/ou le mot de passe n'existe pas !");
            }

            //Utilisateur et mot de passe sont corrects
            //On va pouvoir connecter l'utilisateur
            
            
            //On stock dans $_SESSION les informations de l'utilisateur dans le cookie
            $_SESSION["visiteur"] = [
                "id" => $visiteur["identifiant"],
                "nom" => $visiteur["nom"],
                "prenom" => $visiteur["prenom"],
                "email" => $visiteur["email"]
            ];
            
            //On rediriger vers la page de profil
            header("Location: profil.php");
        }
    }

    include("Common/header.php");
    include("Common/navigation.php");
    
?>
<h2>Connexion</h2>
<section>
    <form method="POST">
        
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="motdepasse">Mot de passe</label><br>
            <input type="password" name="motdepasse" id="motdepasse">
        </div>
        <button type="submit">Me connecter</button>
    </form>
</section>




<?php
    include("Common/footer.php");
?>