<?php

namespace App\Entity;

use Core\Entity\Entity;

class CommentEntity extends Entity{

	/**
	 * récupère l'url de la page partenaire du commentaire
	 * @return 
	 */
	public function getUrl(){
		return 'index.php?p=partners.show&id=' . $this->partner_id;
	}

}