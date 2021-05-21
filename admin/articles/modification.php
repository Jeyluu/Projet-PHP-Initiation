<?php




$title = "Modifier un article";

    include_once "../../Common/admin-header.php";
    include_once "../../Common/navigation.php";

?>


<h2>Modifier un article au forum</h2>
<form method="POST">
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