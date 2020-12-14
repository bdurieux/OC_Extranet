<?php

namespace App\Controller;

use \App;
use Core\Auth\DBAuth;
use Core\HTML\MyForm;
use App\Auth\MyAuth;

class UsersController extends AppController{

	public function __construct(){
		parent::__construct();
		$this->loadModel('User');
        $this->loadModel('Partner');
	}

	/**
	 * affiche le formulaire de connexion et vérifie la validité des identifiants si le formulaire
	 * est rempli
	 * en cas de succès, redirige vers la page d'accueil de gbaf
	 */
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
		
		$variables = $this->compactVariables('Connexion',true,$_POST);
		$variables['errors'] = $errors;
		
		$this->render('users.login', $variables);
		/* $title = "GBAF - Connexion";
		$headerConnexion = $this->showButton();
		$form = new MyForm($_POST);
		$headerText = '<a href="index.php?p=users.inscription">Inscription</a>';
		$this->render('users.login', compact('form', 'headerText','errors', 'headerConnexion','title')); */
	}

	/**
	 * affiche le formulaire de vérification de la question secrète et vérifie si les donnée sont correctes
	 * en cas de succès, redirige vers la page pour choisir un nouveau mot de passe
	 */
	public function forgotPass(){
		$errors = false;
		$unidentified = " btn-hidden";
		$question = "Entrez votre pseudo et répondez à la question.";			
		if (!empty($_POST)) {
			$user = $this->User->findUserByUsername($_POST['username']);			
			if($user){
				$question = $user->question;
				$unidentified = "";
				$auth = new MyAuth(App::getInstance()->getDb());
				if ($auth->question($_POST['username'],$_POST['reponse'])) {
					header('Location: index.php?p=users.newPass');
				}
			}else{
				$errors = true;
			}			
		}
		$variables = $this->compactVariables('Mot de passe oublié',true,$_POST);
		$variables['errors'] = $errors;
		$variables['unidentified'] = $unidentified;
		$variables['question'] = $question;
		$this->render('users.forgotPass', $variables);

		/* $title = "GBAF - Mot de passe oublié?";
		$headerConnexion = $this->showButton();		
		$headerText = '<a href="index.php?p=users.inscription">Inscription</a>';
		$form = new MyForm($_POST);		
		$this->render(
			'users.forgotPass', 
			compact('form','headerText', 'errors','headerConnexion','title','question','unidentified')
		); */ 
	}

	/**
	 * affiche le formulaire pour choisir un nouveau mot de passe
	 * redirige vers la page de connexion une fois validé
	 */
	public function newPass(){
		$errors = false;
		if(!empty($_POST)){			
			$user = $this->User->findUserByUsername($_POST['username']);
			if($user){				
				if(strlen($_POST['password1'])>0 && sha1($_POST['password1']) === sha1($_POST['password2'])){
					//faire l'update du password
					$userTable = App::getInstance()->getTable('User');
					$result = $userTable->update($user->id_user, ['password' => sha1($_POST['password1'])]);
					if($result){
						header('Location: index.php');
					}
				}
			}else{
				$errors = true;
			}
		}
		$variables = $this->compactVariables('Nouveau mot de passe',true,$_POST);
		$variables['errors'] = $errors;		
		$this->render('users.newPass', $variables);

		/* $title = "GBAF - Nouveau mot de passe";
		$headerConnexion = $this->showButton();
		$headerText = '<a href="index.php?p=users.inscription">Inscription</a>';
		$form = new MyForm($_POST);		
		$this->render('users.newPass', compact('form','headerText', 'errors','headerConnexion','title')); */
	}

	/**
	 * affiche le formulaire d'inscription
	 * redirige vers la page de connexion une fois validé
	 */
	public function inscription(){
		$errors = false;
		$message = "";		
		if(!empty($_POST)){
			extract($this->checkParam($_POST));
			if(!$errors){
				//sauvegarde en bdd
				$userTable = App::getInstance()->getTable('User');
				$result = $userTable->create(
					[
						'nom' => $_POST['nom'],
						'prenom' => $_POST['prenom'],
						'username' => $_POST['username'],
						'password' => sha1($_POST['password']),
						'question' => $_POST['question'],
						'reponse' => sha1($_POST['reponse'])
					]
				);
				if($result){
					header('Location: index.php');
				}
			}
		}

		$variables = $this->compactVariables('Inscription',false,$_POST);
		$variables['errors'] = $errors;
		$variables['message'] = $message;
		$this->render('users.inscription', $variables);

		/* $title = "GBAF - Inscription";
		$headerConnexion = $this->showButton();
		$headerText = '<a href="index.php?p=users.login">Se connecter</a>';
		$form = new MyForm($_POST);		
		$this->render(
			'users.inscription', 
			compact('form', 'headerText', 'errors','headerConnexion','title','message')
		); */
	}

	/**
	 * affiche les paramètres du compte dans un formulaire et les mets à jour en cas de validation
	 */
	public function param(){
		$errors = false;
		if(isset($_SESSION['auth'])){
            $user = $this->User->findOne($_SESSION['auth']);
        }else{
            header("Location: index.php");
		} 
		
		//var_dump($this->checkParam($_POST));	/*	DEBUG	*/
		if(!empty($_POST)){
			extract($this->checkParam($_POST));
			if(!$errors){
				//sauvegarde en bdd
				$userTable = App::getInstance()->getTable('User');
				$result = $userTable->update(
					$user->id_user,
					[
						'nom' => $_POST['nom'],
						'prenom' => $_POST['prenom'],
						'username' => $_POST['username'],
						'password' => sha1($_POST['password']),
						'question' => $_POST['question'],
						'reponse' => sha1($_POST['reponse'])
					]
				);
				if($result){
					header('Location: index.php');
				}
			}
		}
		$variables = $this->compactVariables('Paramètres du compte',false,$user);
		$variables['errors'] = $errors;
		$this->render('users.param', $variables);

		/* $title = "GBAF - Paramètres";
		$headerConnexion = $this->showButton();
		$headerText = $user->prenom . ' ' . $user->nom;
		$form = new MyForm($user);
		
		$this->render('users.param', compact('form', 'headerText', 'errors','headerConnexion','title')); */
	}

	/**
	 * ferme la session en cours et redirige vers la page de connexion
	 */
	public function logout(){
		unset($_SESSION['auth']);
		header('Location: index.php?p=users.login');
	}	

	/**
	 * vérifie la validité des paramètres du compte
	 * @param @params 
	 * @return array renvoie un tableau contenant $message et $errors
	 */
	protected function checkParam($params){
		$errors = false;
		$message = "";
		if(isset($_POST['nom']) && strlen($_POST['nom'])<2){
			$message .= "Nom invalide <br>";
			$errors = true;
		}
		if(isset($_POST['prenom']) && strlen($_POST['prenom'])<2){
			$message .= "Prénom invalide <br>";
			$errors = true;
		}
		if(isset($_POST['username']) && strlen($_POST['username'])<4){
			$message .= "Pseudo invalide <br>";
			$errors = true;
		}
		if(isset($_POST['password']) && strlen($_POST['password'])<4){
			$message .= "Mot de passe invalide <br>";
			$errors = true;
		}
		if(isset($_POST['question']) && strlen($_POST['question'])<10){
			$message .= "Question invalide <br>";
			$errors = true;
		}
		if(isset($_POST['reponse']) && strlen($_POST['reponse'])<4){
			$message .= "Réponse invalide <br>";
			$errors = true;
		}
		return compact('message','errors');
	}

}