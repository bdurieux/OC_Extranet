<?php
namespace Core;

class Autoloader{

	static function register(){
		spl_autoload_register(array(__CLASS__, 'autoload'));	// ici __CLASS__ correspond à 'Autoloader'
	}

	static function autoload($class){
		// on ne charge que les classes de notre namespace
		if(strrpos($class, __NAMESPACE__ . '\\') === 0){	// si le nom de la classe commence par 'Tutoriel\'
			//var_dump($class);
			$class = str_replace(__NAMESPACE__ . '\\', '', $class);	//	ici __NAMESPACE__ correspond à 'Tutoriel'
			$class = str_replace('\\', '/', $class);
			require __DIR__ . '/' . $class . '.php';	// ici __DIR__ contient le nom du dossier parent (ici app)
		}
		
	}
}