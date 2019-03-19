<?php
session_start();
session_destroy();
header('location: ../pages/connexion.php');
exit;
?>