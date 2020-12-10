<?php

namespace App\Table;

use Core\Table\Table;

class CommentTable extends Table{

    protected $table = 'comments';	
    
	protected $fakeData = [
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
    ];

	/**
	*	Récupère tous les commentaires sur le partenaire indiqué
	*	@param $category_id int
	*	@return array
	*/
	public function allByPartner($partner_id){
		/*
		return $this->query("
			SELECT *
			FROM comments
			WHERE partner_id = ? 
			ORDER BY date DESC
		",[$partner_id]);
		*/
		$data = [];
		foreach($this->fakeData as $comment){
			if($comment['partner_id'] == $partner_id){
				$data[] = $comment;
			}
		}
		return $data;
	}
	
}