<?php

namespace App\Table;

use Core\Table\Table;

class PartnerTable extends Table{

	protected $table = 'partners';	

	protected $fakeData = [[
			'id' => '2',
			'title' => 'DSA France',
			'description' => 'Quisque vitae fringilla mi. Mauris sit amet aliquam magna, a dignissim libero.',
			'nb_like' => '5',
			'nb_dislike' => '0'
		],
		[
			'id' => '1',
			'title' => 'CDE',
			'description' => 'Vestibulum mollis quis ipsum quis placerat. In hac habitasse platea dictumst.',
			'nb_like' => '11',
			'nb_dislike' => '2'
		]
	];

	public function allOrdered(){
		//return $this->query('SELECT * FROM partners ORDER BY title');
		return $this->fakeData;
	}

	public function findOne($id){
		//var_dump($this->table);
		//return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
		$data = null;
		foreach($this->fakeData as $partner){
			if($partner['id'] == $id){
				$data = $partner;
			}
		}
		return $data;
	}
	
}