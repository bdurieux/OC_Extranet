<?php

namespace App\Auth;

use Core\Database\Database;
use Core\Auth\DBAuth;

class MyAuth extends DBAuth{

    /**
	*	vérifie la réponse à la question secrète fournie correspond avec celle en base de donnée
	*	@param $username
	*	@param $reponse
	*	@return boolean renvoie true si la reponse correspond
	*/
	public function question($username, $reponse){
		$user = $this->db->prepare('SELECT * FROM account WHERE username = ?', [$username], null, true);
		//var_dump(sha1('roux'));   /*  DEBUG   */		
		if ($user) {
			if ($user->reponse === sha1($reponse)) {
				return true;
			}			
		}
		return false;
	}
}