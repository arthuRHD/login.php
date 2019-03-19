<?php
session_start();
session_destroy();
header('location: page_de_connexion.php');
exit;
?>
