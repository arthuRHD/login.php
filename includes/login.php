<?php
require('./database.php');
class Login { 
    private $username;
    private $password;

    public function connect() {
        try {  
            if (password_verify($this->$password,$this->getHashedPassword())) {
                session_start();
                $_SESSION['username'] = $this->$username;   
                header("Location: index.php?login=true&user=".$this->$username);                     
            } else {  
                echo $resultat['pass'];
                echo password_verify($this->$password,$this->getHashedPassword());                                     
                header("Location: index.php?login=false");                                             
            } 
        } catch (Exception $e) {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
        }
    }

    public function disconnect() {
        session_start();
        session_destroy();
        header('location: index.php');
    }

    public function getHashedPassword() {   
        $db = Database::getConnexion();
        $query = "SELECT user, pass FROM login WHERE user = :pseudo";
        $req = $db->prepare($query);
        $req->bindParam(":pseudo",$this->$username);                   
        $req->execute();
        $resultat = $req->fetch();
        $HashedPwdInDb=$res['pass'];
        $req->closeCursor(); 
        return $HashedPwdInDb;
    }
}
