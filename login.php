<?php
if (isset($_POST['bouton_de_connexion'])) { 
    if (empty($_POST['input_pseudo'])) {
        header("Location: page_de_connexion.php");
    } else {        
        if(empty($_POST['input_mdp'])) {
            header("Location: page_de_connexion.php");
        } else {            
            $Pseudo = htmlentities($_POST['input_pseudo']); 
            $MotDePasse = htmlentities($_POST['input_mdp']);            
            require '../includes/fonctions.inc.php';
            $bdd = getBdd();            
            if(!$bdd){
                echo "Erreur de connexion à la base de données.";
            } else {
                try{                                       
                    $query = "SELECT user, pass FROM login WHERE user = :pseudo";
                    $req = $bdd->prepare($query);
                    $req->bindParam(":pseudo",$Pseudo);                   
                    $req->execute();
                    $resultat = $req->fetch();
                    $HashedPwdInDb=$res['pass'];
                    echo $resultat['pass'];
                    if (password_verify($MotDePasse,$HashedPwdInDb)) {
                        session_start();                        
                        $_SESSION['pseudo'] = $Pseudo;   
                        header("Location: acceuil.php?pseudo=$Pseudo");                     
                    } else {  
                        echo $resultat['pass'];
                        echo password_verify($MotDePasse,$HashedPwdInDb);                                     
                        header("Location: page_de_connexion.php");                        ;                      
                    }                   
                    $req->closeCursor();  
                }
                catch (Exception $e){
                    $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
                    die($msg);
                }                
                
            }
        }
    }
}
