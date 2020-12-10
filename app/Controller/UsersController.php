<?php

namespace App\Controller;

use \App;
use Core\Auth\DBAuth;
use Core\HTML\MyForm;

class UsersController extends AppController{

	public function __construct(){
		parent::__construct();
		$this->loadModel('User');
        $this->loadModel('Partner');
	}

	public function login(){
		$errors = false;
		if (!empty($_POST)) {
			$auth = new DBAuth(App::getInstance()->getDb());
			if ($auth->login($_POST['username'],$_POST['password'])) {
				header('Location: index.php?p=partners.index');
			}else{
				$errors = true;
			}
		}	
		$title = "Connexion";
		$connected = $this->showButton(false);
		$form = new MyForm($_POST);
		$headerText = '<a href="index.php?p=users.inscription">Inscription</a>';
		$this->render('users.login', compact('form', 'headerText','errors', 'connected','title'));
	}

	public function forgotPass(){
		$errors = false;
		$title = "Mot de passe oublié?";
		$connected = $this->showButton(false);
		$form = new MyForm($_POST);
		$headerText = '<a href="index.php?p=users.inscription">Inscription</a>';
		$this->render('users.forgotPass', compact('form','headerText', 'errors','connected','title'));
	}

	public function newPass(){
		$errors = false;
		$title = "Nouveau mot de passe";
		$connected = $this->showButton(false);
		$form = new MyForm($_POST);
		$headerText = '<a href="index.php?p=users.inscription">Inscription</a>';
		$this->render('users.newPass', compact('form','headerText', 'errors','connected','title'));
	}

	public function inscription(){
		$errors = false;
		$title = "Inscription";
		$connected = $this->showButton(false);
		$form = new MyForm($_POST);
		$headerText = '<a href="index.php?p=users.login">Se connecter</a>';
		$this->render('users.inscription', compact('form', 'headerText', 'errors','connected','title'));
	}

	public function param(){
		$errors = false;
		$user = $this->User->findOne(2);
		$title = "Paramètres";
		$connected = $this->showButton(true);
		$form = new MyForm($user);
		$headerText = $user['firstname'] . ' ' . $user['lastname'];
		$this->render('users.param', compact('form', 'headerText', 'errors','connected','title'));
	}

	public function logout(){
		unset($_SESSION['auth']);
		header('Location: index.php?p=users.login');
	}

}