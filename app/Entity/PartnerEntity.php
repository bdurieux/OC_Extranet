<?php

namespace App\Entity;

use Core\Entity\Entity;

class PartnerEntity extends Entity{

	/**
	 * récupère l'url de la page du partenaire 
	 * @return 
	 */
	public function getUrl(){
		return 'index.php?p=partners.show&id=' . $this->id_acteur;
	}

	/**
	 * récupère le début de la description du partenaire
	 * @return 
	 */
	public function getExtrait(){
		$html = '<p>' . substr($this->description, 0, 150) . '...</p>';
		$html .= '<p><a href="' . $this->getURL() . '" >Lire la suite</a></p>';
		return $html;
	}

}