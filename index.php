<?php
require("./includes/login.php");
if (isset($_POST)) {
    $user = htmlentities($_POST['accountName']) ?? null;
    $pass = htmlentities($_POST['accountPassword']) ?? null;
    $login = new Login($user, $pass);
    $login.connect();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
</head>
<body>
    <form action="#" method="post">
        <input type="text" name="accountName" placeholder="Nom du compte">
        <input type="password" name="accountPassword" placeholder="Mot de passe">
        <hr>
        <input type="submit" value="Se connecter">
    </form>
    <?php if (isset($_SESSION)) {
    echo "<button onclick='".$login.disconnect()."' >Se déconnecter</button>";
    } ?>
</body>
</html>