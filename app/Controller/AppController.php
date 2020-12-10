<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;

class AppController extends Controller{

	protected $template = 'default';

	public function __construct(){
		$this->viewPath = ROOT . '/app/Views/';
	}

	protected function loadModel($model_name){
		$this->$model_name = App::getInstance()->getTable($model_name);

	}

	/**
	 * renvoie le nom d'une classe css pour cacher le bouton si l'utilisateur n'est pas connecté
	 * ou une chaine vide sinon
	 * @return $connected string 
	 */
	protected function showButton(bool $fakeParam){
		$connected = " btn-hidden";
		if($fakeParam){	 // check SESSION avec DBAuth->logged()
			$connected = "";
		}
		return $connected;
	}
}