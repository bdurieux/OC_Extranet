<?php

namespace App\Controller;

use Core\Controller\Controller;
use Core\HTML\MyForm;
use \App;

class AppController extends Controller{

	protected $template = 'default';

	public function __construct(){
		$this->viewPath = ROOT . '/app/Views/';
	}

	/**
	 * instancie la classe du model dont le nom est passé en paramètre
	 * @param 
	 */
	protected function loadModel($model_name){
		$this->$model_name = App::getInstance()->getTable($model_name);

	}

	/**
	 * renvoie le nom d'une classe css pour cacher les boutons si l'utilisateur n'est pas connecté
	 * ou une chaine vide sinon
	 * @return $connected string 
	 */
	protected function showButton(){
		$connected = " btn-hidden";
		if($this->logged()){	 // check SESSION avec DBAuth->logged()
			$connected = "";
		}
		return $connected;
	}

	/**
	 * vérifie si l'utilisateur est connecté
	 */
	public function logged(){
		return isset($_SESSION['auth']);
	}

	/**
	 * crée et renvoie un tableau contenant les variable title, headerConnexion et headerText
	 * @param $subtitle le sous titre a ajouter au titre
	 * @param $showSignUp bool indique si on doit afficher le lien vers l'inscription
	 * @return array
	 */
	protected function compactVariables($subtitle,$showSignUp,$userParam){
		$title = "GBAF - " . $subtitle;
		$headerConnexion = $this->showButton();
		if($this->logged()){
			$user = $this->User->findOne($_SESSION['auth']);
			$headerText = $user->prenom . ' ' . $user->nom;
		}else{
			if($showSignUp){
				$headerText = '<a href="index.php?p=users.inscription">Inscription</a>';
			}else{
				$headerText = '<a href="index.php?p=users.login">Connexion</a>';
			}			
		}
		$form = new MyForm($userParam);
		return compact('title','headerConnexion','headerText','form');
	}

	/**
	 * nettoie une chaine de caractère
	 * @return
	 */
	protected function secure($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return($data);
	}
	
	/**
	 * Nettoie une valeur insérée dans une page HTML
	 * @param data
	 * @return 
	 */
	protected function cleanData($data) {
		return htmlspecialchars($data, ENT_QUOTES, 'UTF-8', false);
	}
}