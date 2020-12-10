<?php

namespace App\Table;

use Core\Table\Table;

class UserTable extends Table{

	protected $fakeData = [
        [
            'id' => '1',
            'firstname' => 'John',
            'lastname' => 'Doe', 
            'username' => 'JD42', 
            'password' => '1234',
            'question' => 'Surnom de la directrice du collège',
            'response' => 'Rambo12'
        ],
        [
            'id' => '2',
            'firstname' => 'Erika',
            'lastname' => 'Mustermann', 
            'username' => 'EM27', 
            'password' => 'azerty',
            'question' => 'couleur préférée du parain',
            'response' => 'fushia'
        ]
    ];

    public function findOne($id){
		//var_dump($this->table);
		//return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
		$data = null;
		foreach($this->fakeData as $user){
			if($user['id'] == $id){
				$data = $user;
			}
		}
		return $data;
	}

}