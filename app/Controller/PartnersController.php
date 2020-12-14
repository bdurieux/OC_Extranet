<?php

namespace App\Controller;

use \App;
//use Core\Auth\DBAuth;
use Core\HTML\MyForm;

class PartnersController extends AppController{



    public function __construct(){
		parent::__construct();
		$this->loadModel('User');
        $this->loadModel('Partner');
        $this->loadModel('Comment');
        $this->loadModel('Vote');
	}

    /**
     * envoie vers la page d'accueil une fois connecté
     *   
     */
	public function index(){
        $partners = $this->Partner->allOrdered();        
        $errors = false;
        if($this->logged()){
            $user = $this->User->findOne($_SESSION['auth']);
        }else{
            header("Location: index.php");
        }    
        $variables = $this->compactVariables('Accueil',false,$_POST);
		$variables['errors'] = $errors;
        $variables['user'] = $user;
        $variables['partners'] = $partners;
        $this->render('partners.index', $variables);
        
        /* $title = "Accueil GBAF";      
        $headerConnexion = $this->showButton();
        $headerText = $user->prenom . ' ' . $user->nom;
        $this->render(
            'partners.index',
            compact('user', 'partners', 'title', 'headerText', 'errors','headerConnexion')
        );  */       
	}

    /**
     * affiche la page dédié du partenaire
     */
	public function show(){
        
        $errors = false;
        if($this->logged()){
            $user = $this->User->findOne($_SESSION['auth']);
        }else{
            header("Location: index.php");
        }  
        $partner = $this->Partner->findOne($_GET['id']);
        if($partner){            
            if(isset($_POST['comment'])){
                // vérifier validité du commentaire
                if(strlen($_POST['comment'])>4){
                    $commentTable = App::getInstance()->getTable('Comment');
                    // vérifier l'unicité du commentaire
                    if(!$commentTable->findOne($user->id_user, $partner->id_acteur)){
                        //sauver le commentaire en bdd ($user->id_user, $partner->id, $_POST['post'])
                    
                        var_dump("id_user : " . $user->id_user); /*  DEBUG */
                        var_dump("id_acteur : " . $partner->id_acteur); /*  DEBUG */
                        var_dump("post : " . $_POST['comment']); /*  DEBUG */
                        

                        /* $result = $commentTable->create(
                            [
                                'id_user' => $_POST['nom'],
                                'id_acteur' => $_POST['prenom'],
                                'comment' => $_POST['comment']
                            ]
                        );
                        if($result){
                            header('Location: index.php');
                        } */
                    }
                    
                }                
            }elseif(isset($_POST['like'])){
                //$this->vote($user->id_user, $partner->id_acteur, true);
                var_dump($this->vote($user->id_user, $partner->id_acteur, true));
            }elseif(isset($_POST['dislike'])){
                $this->vote($user->id_user, $partner->id_acteur, false);
            }
            /* 
            $title = "Partenaire GBAF - " . $partner->acteur;
            $headerConnexion = $this->showButton();
            $headerText = $user->prenom . ' ' . $user->nom;
            $form = new MyForm($_POST);
            $this->render(
                'partners.show', 
                compact('form','user', 'partner','comments', 'title', 'headerText', 'errors','headerConnexion')
            ); */
            $comments = $this->Comment->allByPartner($partner->id_acteur);
            $variables = $this->compactVariables('Accueil',false,$_POST);
            $variables['errors'] = $errors;
            $variables['user'] = $user;
            $variables['partner'] = $partner;
            $variables['comments'] = $comments;
            $this->render('partners.show', $variables);
        }else{
            header('Location: index.php?p=public.notFound');
        }
        
    }
    
    /**
     * appel la fonction qui sauve la vote en bdd et retourne false si le vote existe deja
     * @param $id_user 
     * @param $id_acteur
     * @param $like 
     * @return false si 1 vote associé à id_user & id_acteur existe deja
     */
    private function vote($id_user,$id_acteur,bool $like){
        $existeDeja = false;
        $value = 1;
        if(!$like){
            $value = -1;
        }
        // vérifier l'unicité du vote
        $voteTable = App::getInstance()->getTable('Vote');
        if(!$voteTable->findOne($id_user, $id_acteur)){
            $voteTable->save(
                [
                    'id_user' => $id_user,
                    'id_acteur' => $id_acteur,
                    'vote' => $value
                ]
            );
            $existeDeja = true;
        }
        return $existeDeja;
    }

}