<?php

namespace App\Table;

use Core\Table\Table;

class CommentTable extends Table{

    protected $table = 'post';	

	/**
	*	Récupère tous les commentaires sur le partenaire indiqué
	*	@param $partner_id int
	*	@return array
	*/
	public function allByPartner($partner_id){
		
		return $this->query("
			SELECT id_post, p.id_user, id_acteur, date_add, post, prenom 
			FROM post p 
				LEFT JOIN account a ON a.id_user = p.id_user 
			WHERE p.id_acteur = ? 
			ORDER BY date_add DESC 
		",[$partner_id]);
	}

	public function findOne($id_user, $id_acteur){
		//var_dump($this->table); /*  DEBUG */
		return $this->query("SELECT * FROM {$this->table} WHERE id_user = ? AND id_acteur = ? ",
		 [$id_user, $id_acteur],
		 true
		);
	}
	
}