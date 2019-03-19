<?php
function getBdd() {
   try{ 		
	$bdd = new PDO("mysql:host=nom_du_serveur;dbname=nom_de_la_base_de_donnée;charset=utf8","user", "pwd");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $bdd;
	}
	catch (Exception $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
}		
?>
