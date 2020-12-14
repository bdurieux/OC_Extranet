<?php

namespace App\Table;

use Core\Table\Table;

class VoteTable extends Table{

    protected $table = 'vote';

    public function save($fields){
        $sql_parts = [];
		$attributes = [];
		foreach ($fields as $key => $value) {
			$sql_parts[] = "$key = ?";
			$attributes[] = $value;
		}
		$sql_part = implode(', ', $sql_parts);
		var_dump("INSERT INTO {$this->table} SET $sql_part ", $attributes);
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