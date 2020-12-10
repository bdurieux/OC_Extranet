<?php

namespace App\Entity;

use Core\Entity\Entity;

class CommentEntity extends Entity{

	public function getUrl(){
		return 'index.php?p=partners.show&id=' . $this->partner_id;
	}

}