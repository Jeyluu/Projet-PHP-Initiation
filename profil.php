<?php
$title = "Profil";

    
    session_start();
    
    include("Common/header.php");
    include("Common/navigation.php");
    
?>
<h2>Bienvenue <b><?= $_SESSION["visiteur"]["nom"] ?> <?= $_SESSION["visiteur"]["prenom"]  ?></b> sur ton espace profil</h2>





<?php
    include("Common/footer.php");
?>