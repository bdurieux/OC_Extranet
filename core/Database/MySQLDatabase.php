<?php

namespace Core\Database;

use \PDO;

class MySQLDatabase extends Database{

	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $pdo;

	public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost'){
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
	}

	private function getPDO(){
		if($this->pdo === null){
			//$pdo = new PDO('mysql:dbname=blog_grafikart;host=localhost', 'root','');
			$pdo = new PDO('mysql:dbname=' . $this->db_name .
			 ';host=' . $this->db_host . '', '' . $this->db_user . '','' . $this->db_pass . '',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	// pour afficher les erreurs lors du développement
			$this->pdo = $pdo;
		}
		
		return $this->pdo;
	}

	public function query($statement, $class_name = null, $one = false){
		
		$req = $this->getPDO()->query($statement);

		if (
			strpos($statement, 'UPDATE') === 0 || 
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0
			) {
			return $req;
		}

		if($class_name === null){
			$req->setFetchMode(PDO::FETCH_OBJ);
		}else{
			$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
		}		
		if($one){	// si un seul résultat est désiré (plutot qu'un tableau)
			$data = $req->fetch();
		}else{
			$data = $req->fetchall();
		}
		return $data;
	}

	public function prepare($statement, $attributes, $class_name = null, $one = false){
		$req = $this->getPDO()->prepare($statement);
		$res = $req->execute($attributes);
		if (
			strpos($statement, 'UPDATE') === 0 || 
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0
			) {
			return $res;
		}
		if($class_name === null){
			$req->setFetchMode(PDO::FETCH_OBJ);
		}else{
			$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
		}	

		if($one){	// si un seul résultat est désiré (plutot qu'un tableau)
			$data = $req->fetch();
		}else{
			$data = $req->fetchall();
		}
		
		return $data;
	}

	public function lastInsertId(){
		return $this->getPDO()->lastInsertId();
	}

}