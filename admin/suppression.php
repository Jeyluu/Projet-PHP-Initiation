<?php
/* ****************************  Reprise de données **************************** */

//Je récupère l'ID
$id = $_GET["id"];


//On va chercher les articles dans la base de données
require_once("../Common/connexionbdd.php");

//On écrit la requete
$sql = "DELETE  FROM `article` WHERE `id` = :id";

//On prépare la requete
$requete = $db->prepare($sql);

//On injecte les paramètres
$requete->bindValue(":id", $id, PDO::PARAM_INT);

//On execute la requete
$requete->execute();

header('Location: administrateur.php');

//On récupère l'article
$article = $requete->fetch();


$title = "Supression un article";

    include_once "../Common/admin-header.php";
    include_once "../Common/navigation.php";

?>


<?php

    include_once "../Common/footer.php";

?>