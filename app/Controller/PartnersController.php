<?php

namespace App\Controller;

use \App;
//use Core\Auth\DBAuth;
//use Core\HTML\BootstrapForm;

class PartnersController extends AppController{

    public function __construct(){
		parent::__construct();
		$this->loadModel('User');
        $this->loadModel('Partner');
        $this->loadModel('Comment');
	}

    /**
     * envoie vers la page d'accueil une fois connecté
     *   
     */
	public function index(){
        $partners = $this->Partner->allOrdered();
        
        $title = "Accueil";
        $errors = false;
        $user = $this->User->findOne(2);
        
        $connected = $this->showButton(true);
        $headerText = $user['firstname'] . ' ' . $user['lastname'];
        $this->render(
            'partners.index',
            compact('user', 'partners', 'title', 'headerText', 'errors','connected')
        );        
	}

    /**
     * affiche la page dédié du partenaire
     */
	public function show(){
        
        $errors = false;
        $user = $this->User->findOne(2);
		$partner = $this->Partner->findOne(2);
        $comments = $this->Comment->allByPartner($partner['id']);
        $title = "Partenaire GBAF - " . $partner['title'];
        $connected = $this->showButton(true);
        $headerText = $user['firstname'] . ' ' . $user['lastname'];
		$this->render(
            'partners.show', 
            compact('user', 'partner','comments', 'title', 'headerText', 'errors','connected')
        );
	}

}