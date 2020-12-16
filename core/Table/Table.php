<?php

namespace Core\Table;

use Core\Database\Database;

class Table{

	protected $table;
	protected $db;

	public function __construct(Database $db){
		$this->db = $db;
		if (is_null($this->table)) {
			$parts = explode('\\', get_class($this));
			$class_name = end($parts);
			$this->table = strtolower(str_replace('Table', '', $class_name)) . 's';
		}
		
	}

	/**
	 * récupère toutes les données de la table choisie
	 * @return 
	 */
	public function all(){
		return $this->query('SELECT * FROM ' . $this->table);
	}

	/**
	 * récupère l'élément de la table dont on fourni l'id
	 * @param id 
	 * @return 
	 */
	public function find($id){
		return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
	}

	/**
	 * met à jour un élément d'une table dont on fourni l'id et les champs à modifier
	 * @param id 
	 * @param array fields liste des clés/valeurs à modifier
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
		return $this->query("UPDATE {$this->table} SET $sql_part WHERE id = ?", $attributes, true);
	}

	/**
	 * supprime 1 élément de la table dont on fourni l'id
	 * @param id
	 * @return 
	 */
	public function delete($id){
		return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
	}

	/**
	 * crée un élément de la table dont on fourni les valeurs
	 * @param array fields liste des clés/valeurs à insérer
	 */
	public function create($fields){
		$sql_parts = [];
		$attributes = [];
		foreach ($fields as $key => $value) {
			$sql_parts[] = "$key = ?";
			$attributes[] = $value;
		}
		$sql_part = implode(', ', $sql_parts);
		return $this->query("INSERT INTO {$this->table} SET $sql_part ", $attributes, true);
	}

	/**
	 * renvoie les éléments de la table sous forme de tableau clé/valeur
	 * @param key
	 * @param value
	 * @return array 
	 */
	public function extract($key, $value){
		$records = $this->all();
		$return = [];
		foreach ($records as $v) {
			$return[$v->$key] = $v->$value;
		}
		return $return;
	}

	/**
	 * fait une requête sur la table 
	 * @param statement la requête à faire
	 * @param attributes liste des paramètres (pour requete préparer)
	 * @param one indique si l'on veux un seul résultat ou tous
	 * @return 
	 */
	public function query($statement, $attributes = null, $one = false){
		if($attributes){
			return $this->db->prepare(
				$statement, 
				$attributes, 
				str_replace('Table', 'Entity', get_class($this)), 
				$one
			);
		}else{
			return $this->db->query(
				$statement, 
				str_replace('Table', 'Entity', get_class($this)), 
				$one
			);
		}

	}
	
}