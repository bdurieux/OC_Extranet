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
		/* $title = "GBAF - Mentions légales";
		$headerConnexion = $this->showButton();
		if($this->logged()){
			$user = $this->User->findOne($_SESSION['auth']);
			$headerText = $user->prenom . ' ' . $user->nom;
			//$headerText = $user['firstname'] . ' ' . $user['lastname'];
		}else{
			$headerText = '<a href="index.php?p=users.login">Connexion</a>';
		} */
		$variables = $this->compactVariables('Mentions légales',true,$_POST);
		$this->render('public.legal', $variables);
		//$this->render('public.legal', compact('headerText','headerConnexion','title'));
	}

	/**
	 * affiche le formulaire de contact
	 */
	public function contact(){
		/* $title = "GBAF - Contact";
		$headerConnexion = $this->showButton();
		if($this->logged()){
			$user = $this->User->findOne($_SESSION['auth']);
			$headerText = $user->prenom . ' ' . $user->nom;
			$form = new MyForm($_POST);
		}else{
			$headerText = '<a href="index.php?p=users.login">Connexion</a>';
			$form = new MyForm($_POST);
		} */
		$variables = $this->compactVariables('Contact',true,$_POST);
		if($this->logged()){
			$user = $this->User->findOne($_SESSION['auth']);
			$variables['user'] = $user;
		}
		//$this->render('public.contact', compact('form','headerText','headerConnexion','title'));
		$this->render('public.contact', $variables);
	}

	/**
	 * affiche page introuvable
	 */
	public function notFound(){
		/* $title = "GBAF - Page introuvable";
		$headerConnexion = $this->showButton();
		if($this->logged()){
			$user = $this->User->findOne($_SESSION['auth']);
			$headerText = $user->prenom . ' ' . $user->nom;
		}else{
			$headerText = '<a href="index.php?p=users.login">Connexion</a>';
		} */
		$variables = $this->compactVariables('Page introuvable',true);
		//var_dump($variables);	/*	DEBUG */
		if($this->logged()){
			$user = $this->User->findOne($_SESSION['auth']);
			$variables['user'] = $user;
		}
		//$this->render('public.notFound', compact('headerText','headerConnexion','title'));
		$this->render('public.notFound', $variables);
	}
}