<?php

namespace App\Table;

use Core\Table\Table;

class PartnerTable extends Table{

	protected $table = 'acteur';	

	/**
	 * récupère la liste des acteurs par ordre alphabétique
	 * @return 
	 */
	public function allOrdered(){
		return $this->query('SELECT * FROM acteur ORDER BY acteur');
	}

	/**
	 * retourne l'acteur dont on fourni l'id en paramètre
	 * @param $id 
	 * @return 
	 */
	public function findOne($id){
		return $this->query("SELECT * FROM {$this->table} WHERE id_acteur = ?", [$id], true);
	}
	
}