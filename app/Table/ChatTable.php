<?php

namespace App\Table;

use Core\Table\Table;

class ChatTable extends Table{

    protected $table = 'chat';	

    /**
     * récupère les 10 derniers messages posté
     */
	public function lasts(){
		return $this->query("
            SELECT id, c.id_user, message, date_add, a.username 
            FROM {$this->table} c 
                LEFT JOIN account a ON a.id_user = c.id_user              
            ORDER BY date_add DESC 
            LIMIT 10"
        );
	}
	
}