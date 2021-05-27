<nav>
    <ul>
    <?php if(isset($_SESSION["visiteur"])): ?>
        <li><a href="../deconnexion.php">Déconnexion</a></li>
        <li><a href="../profil.php">Profil</a></li>
        <li><a href="admin/administrateur.php">Espace Administrateur</a></li>
        <li><a href="../visiteur.php">Espace Visiteur</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <?php else: ?>
        <li><a href="../visiteur.php">Connexion</a></li>
        <li><a href="../inscription.php">Inscription</a></li>
        <li><a href="../articles.php">Les mises à jours</a></li>
        <li><a href="../index.php">Accueil</a></li>
        <?php endif;?>
    </ul>
</nav>