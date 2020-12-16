<?php

namespace App\Table;

use Core\Table\Table;

class UserTable extends Table{

    protected $table= "account";

    /**
     * récupère le compte qui a l'id fourni en paramètre
     * @param $id 
     * @return 
     */
    public function findOne($id){
        return $this->query("SELECT * FROM {$this->table} WHERE id_user = ?", [$id], true);
    }
    
    /**
     * récupère le compte dont on fourni le pseudo en paramètre
     * @param username 
     * @return 
     */
    public function findUserByUsername($username){
        return $this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
    }

    /**
     * met à jour la table selon l'id utilisateur fournie et les champs à modifier
     * @param $id  id de l'utilisateur
     * @param array $fields champs à modifier et leurs valeurs
     * @return 
     */
    public function update($id, $fields){
		$sql_parts = [];
		$attributes = [];
		foreach ($fields as $key => $value) {
			$sql_parts[] = "$key = ?";
			$attributes[] = $value;
		}
		$attributes[] = $id;
		$sql_part = implode(', ', $sql_parts);
		return $this->query("UPDATE {$this->table} SET $sql_part WHERE id_user = ?", $attributes, true);
	}
}