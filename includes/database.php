<?php
class Database {
	private static $host='localhost';
	private static $db='my_db_name';
	private static $user='my_db_user';
	private static $mdp='my_db_password';
	private static $Connexion;	

	private function __construct() {
		Database::$Connexion = new PDO(Database::$host.';dbname='.Database::$db, Database::$user, Database::$mdp); 
		Database::$Connexion->query("SET CHARACTER SET utf8");
	}

	private function __destruct() {
		Database::$Connexion = null;
	}

	public static function getConnexion() {
		if (Database::$Connexion == null) {
			Database::$Connexion = new Database();
		}
		return Database::$Connexion;
	}
}
