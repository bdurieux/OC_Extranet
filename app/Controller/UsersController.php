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
		$this->loadModel('Chat');
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
			if ($auth->login($this->secure($_POST['username']),$this->secure($_POST['password']))) {		
				header('Location: index.php?p=partners.index');
			}else{
				$errors = true;
			}
		}		
		$variables = $this->compactVariables('Connexion',true,$_POST);
		$variables['errors'] = $errors;		
		$this->render('users.login', $variables);
	}

	/**
	 * affiche le formulaire de vérification de la question secrète et vérifie si les donnée sont correctes
	 * en cas de succès, redirige vers la page pour choisir un nouveau mot de passe
	 */
	public function forgotPass(){
		$errors = false;
		$message = "";
		$unidentified = " btn-hidden";
		$question = "Entrez votre pseudo et répondez à la question.";			
		if (!empty($_POST)) {
			$user = $this->User->findUserByUsername($this->secure($_POST['username']));			
			if($user){
				$question = $user->question;
				$unidentified = "";
				$auth = new MyAuth(App::getInstance()->getDb());
				if ($auth->question($this->secure($_POST['username']),$this->secure($_POST['reponse']))) {
					header('Location: index.php?p=users.newPass');
				}else{
					$errors = true;
					$message = "Identifiants incorrects.";
				}
			}else{
				$errors = true;
				$message = "Pseudo inconnu.";
			}			
		}
		$variables = $this->compactVariables('Mot de passe oublié',true,$_POST);
		$variables['errors'] = $errors;
		$variables['message'] = $message;
		$variables['unidentified'] = $unidentified;
		$variables['question'] = $question;
		$this->render('users.forgotPass', $variables);
	}

	/**
	 * affiche le formulaire pour choisir un nouveau mot de passe
	 * redirige vers la page de connexion une fois validé
	 */
	public function newPass(){
		$errors = false;
		if(!empty($_POST)){			
			$user = $this->User->findUserByUsername($this->secure($_POST['username']));
			if($user){				
				if(strlen($this->secure($_POST['password1']))>0 
					&& $this->secure($_POST['password1']) === $this->secure($_POST['password2'])){
					//faire l'update du password
					$userTable = App::getInstance()->getTable('User');
					$result = 
						$userTable->update($user->id_user,
						 ['password' => password_hash($this->secure($_POST['password1']),PASSWORD_DEFAULT)]);
						//$userTable->update($user->id_user, ['password' => sha1($_POST['password1'])]);
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
				$userTable = App::getInstance()->getTable('User');
				// vérification de l'unicité du pseudo
				if($userTable->findUserByUsername($this->secure($_POST['username']))){
					$errors = true;
					$message = "Pseudo déjà utilisé.";
				}else{
					$result = $userTable->create(
						[
							'nom' => $this->secure($_POST['nom']),
							'prenom' => $this->secure($_POST['prenom']),
							'username' => $this->secure($_POST['username']),
							'password' => password_hash($this->secure($_POST['password']),PASSWORD_DEFAULT),
							'question' => $this->secure($_POST['question']),
							'reponse' => password_hash($this->secure($_POST['reponse']),PASSWORD_DEFAULT)
						]
					);
					if($result){
						header('Location: index.php');
					}
				}				
			}
		}
		$variables = $this->compactVariables('Inscription',false,$_POST);
		$variables['errors'] = $errors;
		$variables['message'] = $message;
		$this->render('users.inscription', $variables);
	}

	/**
	 * affiche les paramètres du compte dans un formulaire et les mets à jour en cas de validation
	 */
	public function param(){
		$errors = false;
		$message = "";	
		// vérification de l'authentification
		if(isset($_SESSION['auth'])){
            $user = $this->User->findOne($_SESSION['auth']);
        }else{
            header("Location: index.php");
		} 
		
		if(!empty($_POST)){
			extract($this->checkParam($_POST));
			if(!$errors){
				//sauvegarde en bdd
				$userTable = App::getInstance()->getTable('User');
				$pseudoUser = $userTable->findUserByUsername($this->secure($_POST['username']));
				// on vérifie que le pseudo n'est pas deja utilisé par un autre user
				if($pseudoUser != false && ($pseudoUser->id_user != $user->id_user)){
					$errors = true;
					$message .= "Pseudo déjà utilisé.";
				}else{
					$result = $userTable->update(
						$user->id_user,
						[
							'nom' => $this->secure($_POST['nom']),
							'prenom' => $this->secure($_POST['prenom']),
							'username' => $this->secure($_POST['username']),
							'password' => password_hash($this->secure($_POST['password']),PASSWORD_DEFAULT),
							'question' => $this->secure($_POST['question']),
							'reponse' => password_hash($this->secure($_POST['reponse']),PASSWORD_DEFAULT)
						]
					);
					if($result){
						header('Location: index.php');
					}
				}			
			}
		}
		$variables = $this->compactVariables('Paramètres du compte',false,$user);
		$variables['errors'] = $errors;
		$variables['message'] = $message;
		$this->render('users.param', $variables);
	}

	/**
	 * ferme la session en cours et redirige vers la page de connexion
	 */
	public function logout(){
		unset($_SESSION['auth']);
		header('Location: index.php?p=users.login');
	}	

	/**
	 * affiche le chat pour les utilisateurs connecté
	 */
	public function chat(){
		$errors = false;
		$message = "";	
		// vérification de l'authentification
		if(isset($_SESSION['auth'])){
            $user = $this->User->findOne($_SESSION['auth']);
        }else{
            header("Location: index.php");
		} 
		if(isset($_POST['chat'])){	// ajout d'un message demandé
			// vérification de la validité du message
			if(strlen($this->secure($_POST['chat']))>1 && strlen($this->secure($_POST['chat']))<255){
				$chatTable = App::getInstance()->getTable('Chat');
				$result = $chatTable->create(
					[
						'id_user' => $user->id_user,
						'message' => $this->secure($_POST['chat'])
					]
				);				
			}else{
				$errors = true;
				$message = "Message invalide.";
			} 
		}
		$chats = $this->Chat->lasts();
		$variables = $this->compactVariables('Chat',false,$_POST);
		$variables['errors'] = $errors;
		$variables['message'] = $message;
		$variables['chats'] = $chats;
		$variables['user'] = $user;
		$this->render('users.chat', $variables);
	}

	/**
	 * vérifie la validité des paramètres du compte
	 * @param @params 
	 * @return array renvoie un tableau contenant $message et $errors
	 */
	protected function checkParam($params){
		$errors = false;
		$message = "";
		if(isset($_POST['nom']) && strlen($this->secure($_POST['nom']))<2){
			$message .= "Nom invalide <br>";
			$errors = true;
		}
		if(isset($_POST['prenom']) && strlen($this->secure($_POST['prenom']))<2){
			$message .= "Prénom invalide <br>";
			$errors = true;
		}
		if(isset($_POST['username']) && strlen($this->secure($_POST['username']))<4){
			$message .= "Pseudo invalide <br>";
			$errors = true;
		}
		if(isset($_POST['password']) && strlen($this->secure($_POST['password']))<4){
			$message .= "Mot de passe invalide <br>";
			$errors = true;
		}
		if(isset($_POST['question']) && strlen($this->secure($_POST['question']))<10){
			$message .= "Question invalide <br>";
			$errors = true;
		}
		if(isset($_POST['reponse']) && strlen($this->secure($_POST['reponse']))<4){
			$message .= "Réponse invalide <br>";
			$errors = true;
		}
		return compact('message','errors');
	}

}