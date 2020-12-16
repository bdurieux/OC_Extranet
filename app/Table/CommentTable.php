<?php

namespace App\Table;

use Core\Table\Table;

class CommentTable extends Table{

    protected $table = 'post';	
    
	/* protected $fakeData = [
        [
			'id' => '1',
			'date' => '2020-08-25 15:44:50',
			'content' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
			'user_id' => '1',
			'partner_id' => '2'
		],
        [
			'id' => '2',
			'date' => '2020-10-25 10:24:30',
			'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a tincidunt orci. Nullam nulla enim, laoreet non blandit nec, commodo sed ligula. Donec sapien eros, pulvinar sed rutrum sed, pretium. ',
			'user_id' => '2',
			'partner_id' => '1'
		],
        [
			'id' => '3',
			'date' => '2020-12-5 15:21:20',
			'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a tincidunt orci. Nullam nulla enim, laoreet non blandit nec, commodo sed ligula. Donec sapien eros, pulvinar sed rutrum sed, pretium. ',
			'user_id' => '2',
			'partner_id' => '2'
		]
    ]; */

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
		
		/* $data = [];
		foreach($this->fakeData as $comment){
			if($comment['partner_id'] == $partner_id){
				$data[] = $comment;
			}
		}
		return $data; */
	}

	public function findOne($id_user, $id_acteur){
		//var_dump($this->table); /*  DEBUG */
		return $this->query("SELECT * FROM {$this->table} WHERE id_user = ? AND id_acteur = ? ",
		 [$id_user, $id_acteur],
		 true
		);
		/* $data = null;
		foreach($this->fakeData as $partner){
			if($partner['id'] == $id){
				$data = $partner;
			}
		}
		return $data; */
	}
	
}