<?php
    require_once("Common/fonctions.php");
    include("Common/header.php");
    include("Common/navigation.php");
?>

    <img src="ressources/images/banniere.jpg" alt="banniereProjetMMORPG">



<?php
    require_once("Common/connexionbdd.php");
    
    $nom = "test1";
    $motdepasse = "test";

    //Requête préparée

    $sql = "SELECT * FROM `visiteurs` WHERE `nom` = :nom AND `motdepasse`= :mdp";

    $requete = $db->prepare($sql);

    //On injecte les valeurs "bindValue"
    $requete->bindParam(":nom",$nom, PDO::PARAM_STR);
    $requete->bindValue(":mdp",$motdepasse, PDO::PARAM_STR);

    $nom = "Jean"; // si ne colle pas avec le mot de passe il ne trouvera rien

    //On execute la requete
    $requete->execute();

    $visiteur = $requete->fetchAll();

    echo "<pre>";
    var_dump($visiteur);
    echo "</pre>";

    include("Common/footer.php");
?>