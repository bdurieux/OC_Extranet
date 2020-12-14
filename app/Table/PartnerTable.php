<?php

namespace App\Table;

use Core\Table\Table;

class PartnerTable extends Table{

	protected $table = 'acteur';	

	/* protected $fakeData = [[
			'id' => '1',
			'title' => 'Formation & co',
			'description' => 'Formation&co est une association française présente sur tout le territoire.
			Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.
			Notre proposition : 
			un financement jusqu’à 30 000€ ;
			un suivi personnalisé et gratuit ;
			une lutte acharnée contre les freins sociétaux et les stéréotypes.
			
			Le financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.
			Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.',
			'nb_like' => '5',
			'nb_dislike' => '0'
		],
		[
			'id' => '2',
			'title' => 'Protectpeople',
			'description' => 'Protectpeople finance la solidarité nationale.
			Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.
			
			Chez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.
			Proectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.
			Nous garantissons un accès aux soins et une retraite.
			Chaque année, nous collectons et répartissons 300 milliards d’euros.
			Notre mission est double :
			sociale : nous garantissons la fiabilité des données sociales ;
			économique : nous apportons une contribution aux activités économiques.',
			'nb_like' => '11',
			'nb_dislike' => '2'
		],
		[
			'id' => '3',
			'title' => 'DSA France',
			'description' => 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.
			Nous accompagnons les entreprises dans les étapes clés de leur évolution.
			Notre philosophie : s’adapter à chaque entreprise.
			Nous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.',
			'nb_like' => '7',
			'nb_dislike' => '1'
		],
		[
			'id' => '4',
			'title' => 'CDE',
			'description' => 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. 
			Son président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.',
			'nb_like' => '3',
			'nb_dislike' => '4'
		]
	]; */
	/**
	 * récupère la liste des acteurs par ordre alphabétique
	 * @return 
	 */
	public function allOrdered(){
		return $this->query('SELECT * FROM acteur ORDER BY acteur');
		//return $this->fakeData;
	}

	/**
	 * return l'acteur dont on fourni l'id en paramètre
	 * @param $id 
	 * @return 
	 */
	public function findOne($id){
		//var_dump($this->table); /*  DEBUG */
		return $this->query("SELECT * FROM {$this->table} WHERE id_acteur = ?", [$id], true);
		/* $data = null;
		foreach($this->fakeData as $partner){
			if($partner['id'] == $id){
				$data = $partner;
			}
		}
		return $data; */
	}
	
}