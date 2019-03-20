<?php

class DAO {
	
	private $host = "###";
	private $database = "###";
	private $user = "###";
	private $password = "###";
	private $charset = "utf8";
	
	private $db;
	private $error;
	
	public function __construct() {
		
	}
	
	public function connect() {
		try {
			$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database.';charset='.$this->charset, $this->user, $this->password);
		} catch (Exception $e) {
			$this->error = $e->getMessage();
		}
	}
	
	public function user($login) {
		$req = $this->db->prepare('SELECT * FROM meteo2 WHERE user_name = ?');
		$req->execute(array($login));
		$user = $req->fetch();
		return $user['user_name'];
	}
	
	public function password($login) {
		$req = $this->db->prepare('SELECT password FROM meteo2 WHERE user_name = ?');
		$req->execute(array($login));
		$password = $req->fetch();
		return $password['password'];		
	}
	
	public function checkUsers($user) {
		$req = $this->db->query('SELECT user_name FROM meteo2');
		$found = false;
		while ($users = $req->fetch()) {
			if ($users['user_name'] == $user) {
				$found = true;
			}
		}
		return $found;
	}

	public function checkEmail($email) {
		$req = $this->db->query('SELECT email FROM meteo2');
		$found = false;
		while ($users = $req->fetch()) {
			if ($users['email'] == $email) {
				$found = true;
			}
		}
		return $found;
	}
	
	public function userCreate($user, $email, $password) {
		$req = $this->db->prepare('INSERT INTO meteo2 (id_user, user_name, email, password) VALUES (NULL, ?, ?, MD5(?))');
		$req->execute(array($user, $email, $password));
	}
	
	public function resetPassword($pass, $email) {
		$req = $this->db->prepare('UPDATE meteo SET password = ? WHERE MD5(email) LIKE ?');
		$req->execute(array(md5($pass), $email));
	}
}