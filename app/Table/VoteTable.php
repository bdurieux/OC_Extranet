<?php

namespace App\Table;

use Core\Table\Table;

class VoteTable extends Table{

    protected $table = 'vote';

	/**
	 * 
	 */
    public function save($fields){
        $sql_parts = [];
		$attributes = [];
		foreach ($fields as $key => $value) {
			$sql_parts[] = "$key = ?";
			$attributes[] = $value;
		}
		$sql_part = implode(', ', $sql_parts);
		/*var_dump("INSERT INTO {$this->table} SET $sql_part ", $attributes);	/*	DEBUG	*/
		return $this->query("INSERT INTO {$this->table} SET $sql_part ", $attributes, true);
    }

	/**
	 * récupère le vote correspondant aux paramètres
	 * @param $id_user
	 * @param $id_acteur
	 * @return
	 */
    public function findOne($id_user, $id_acteur){
		return $this->query("SELECT * FROM {$this->table} WHERE id_user = ? AND id_acteur = ? ",
		 [$id_user, $id_acteur],
		 true
		);
	}

	/**
	 * récupère le nombre de like/dislike concernant un partenaire
	 * @param id_acteur
	 * @param bool true pour récupérer les like, false pour les dislike
	 * @return
	 */
	public function count($id_acteur, bool $like){
		$value = -1;
		if($like){
			$value = 1;
		}
		/* $result = $this->query("SELECT COUNT(*) AS total FROM {$this->table} WHERE vote = ? AND id_acteur = ? ",
			[$value, $id_acteur],
			true
		); */
		$result = $this->db->prepare(
			"SELECT * FROM {$this->table} WHERE vote = ? AND id_acteur = ? ",
			[$value, $id_acteur]
		);
		
		return sizeof($result);
	}
}