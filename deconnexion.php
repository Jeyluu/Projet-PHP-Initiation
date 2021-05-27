<?php
session_start();
//Supprime un variable pour deocnnexion
unset($_SESSION["visiteur"]);
header ("Location: index.php");
?>