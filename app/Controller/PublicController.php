<?php

namespace App\Controller;

use \App;
use Core\HTML\MyForm;

class PublicController extends AppController{

    public function __construct(){
		parent::__construct();
		$this->loadModel('User');
	}

	/**
	 * affiche la page de mention légales
	 */
    public function legal(){
		$variables = $this->compactVariables('Mentions légales',true,$_POST);
		$this->render('public.legal', $variables);
	}

	/**
	 * affiche le formulaire de contact
	 */
	public function contact(){
		$variables = $this->compactVariables('Contact',true,$_POST);
		if($this->logged()){
			$user = $this->User->findOne($_SESSION['auth']);
			$variables['user'] = $user;
		}
		$this->render('public.contact', $variables);
	}

	/**
	 * affiche page introuvable
	 */
	public function notFound(){
		$variables = $this->compactVariables('Page introuvable',true);
		if($this->logged()){
			$user = $this->User->findOne($_SESSION['auth']);
			$variables['user'] = $user;
		}
		$this->render('public.notFound', $variables);
	}
}