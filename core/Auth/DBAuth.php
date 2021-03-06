<?php

namespace Core\Auth;

use Core\Database\Database;

class DBAuth{

	protected $db;

	public function __construct(Database $db){
		$this->db = $db;
	}

	/**
	 * récupère le userId si l'utilisateur est connecté
	 * @return  
	 */
	public function getUserId(){
		if ($this->logged()) {
			return $_SESSION['auth'];
		}
		return false;
	}


	/**
	*	vérifie le mot de passe fourni avec celui en base de donnée
	*	@param $username
	*	@param $password
	*	@return boolean renvoie true si le mot de passe correspond
	*/
	public function login($username, $password){
		$user = $this->db->prepare('SELECT * FROM account WHERE username = ?', [$username], null, true);
		//var_dump(sha1('star'));   /*  DEBUG   */
		//var_dump(password_hash('star',PASSWORD_DEFAULT));
		if ($user) {
			var_dump($user->password);
			var_dump(password_hash($password,PASSWORD_DEFAULT));
			if(password_verify($password,$user->password)){
				$_SESSION['auth'] = $user->id_user;
				setcookie('username', $user->username, time() + (86400 * 30), "/");
				return true;
			}			
		}
		return false;
	}

	/**
	 * vérifie si l'utilisateur est connecté
	 */
	public function logged(){
		return isset($_SESSION['auth']);
	}

}

