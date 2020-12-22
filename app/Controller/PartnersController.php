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
	}

    /**
     * affiche la page dédié du partenaire
     */
	public function show(){ 
        $errors = false;
        $message = "";
        if($this->logged()){
            $user = $this->User->findOne($_SESSION['auth']);
        }else{
            header("Location: index.php");
        }  
        $partner = $this->Partner->findOne($_GET['id']);
        if($partner){        
            /**********************************************************************/
            //$partner->description = $this->createUL($partner->description);
            /**********************************************************************/
            if(isset($_POST['comment'])){   // ajout d'un commentaire demandé
                // vérifier validité du commentaire
                if(strlen($_POST['comment'])>4){
                    $commentTable = App::getInstance()->getTable('Comment');
                    // vérifier l'unicité du commentaire
                    if(!$commentTable->findOne($user->id_user, $partner->id_acteur)){
                        //sauver le commentaire en bdd ($user->id_user, $partner->id, $_POST['post'])
                        $result = $commentTable->create(
                            [
                                'id_user' => $user->id_user,
                                'id_acteur' => $partner->id_acteur,
                                'post' => $_POST['comment']
                            ]
                        );
                        if($result){
                            header('Location: index.php?p=partners.show&id=' . $partner->id_acteur);
                        }
                    }else{
                        $errors = true;
                        $message = "Vous avez déjà commenté cet acteur.";
                    }                    
                }                
            }elseif(isset($_POST['like'])){ // ajout d'un like
                if(!$this->vote($user->id_user, $partner->id_acteur, true)){
                    $message = "Vous avez déjà voté pour  cet acteur.";
                }
            }elseif(isset($_POST['dislike'])){  // ajout d'un dislike
                if(!$this->vote($user->id_user, $partner->id_acteur, false)){
                    $message = "Vous avez déjà voté pour  cet acteur.";
                }                
            }
            $nb_like = $this->Vote->count($partner->id_acteur,true);
            $nb_dislike = $this->Vote->count($partner->id_acteur,false);
            $comments = $this->Comment->allByPartner($partner->id_acteur);
            $variables = $this->compactVariables('Accueil',false,$_POST);
            $variables['errors'] = $errors;
            $variables['message'] = $message;
            $variables['user'] = $user;
            $variables['partner'] = $partner;
            $variables['comments'] = $comments;
            $variables['nb_like'] = $nb_like;
            $variables['nb_dislike'] = $nb_dislike;
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

    /**
     * transforme une string avec un : suivi de ; en <ul></ul>
     * @param $text
     * @return 
     */
    private function createUL($text){
        $parts = explode(':',$text);
        $html = '';
        if(sizeof($parts)>1){
            $pattern = "#.+(.;+.+)#";            
            foreach($parts as $part){
                if(preg_match($pattern, $part)){
                    $pieces = explode(';', $part);
                    $list = ':<ul style="list-style-type:none">';
                    foreach($pieces as $piece){
                        $list .= '<li>';
                        $pdot = explode(".", $piece);
                        $afterUL = substr($piece, strlen($pdot[0])+1);
				        $end = (strlen($afterUL) == 0)? '' : ':';
                        if (sizeof($pdot)>1) {
                            $list .= $pdot[0] . '</li></ul>' . substr($piece, strlen($pdot[0])+1) . $end;
                        }else{
                            $list .= $piece . '</li>';
                        }
                    }
                    $html .= $list;
                }else{
                    $html .= $part;
                }                
            }            
        }else{
            $html = $text;
        }
        return $html;
    }
}