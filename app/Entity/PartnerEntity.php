<?php

namespace App\Entity;

use Core\Entity\Entity;

class PartnerEntity extends Entity{

	public function getUrl(){
		return 'index.php?p=partners.show&id=' . $this->id;
	}

	public function getExtrait(){
		$html = '<p>' . substr($this->description, 0, 100) . '...</p>';
		$html .= '<p><a href="' . $this->getURL() . '" >Lire la suite</a></p>';
		return $html;
	}

}