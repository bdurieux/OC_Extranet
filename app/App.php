<?php 

use Core\Config;
use Core\Database\MySQLDatabase;

class App{

	public $title = "Mon super site";
	private $db_instance;
	private static $_instance;

	private function __construct(){

	}

	/**
	 * singleton pour récupérer l'instance de l'application
	 * @return 
	 */
	public static function getInstance(){
		if (is_null(self::$_instance)) {
			self::$_instance = new App();
		}
		return self::$_instance;
	}

	/**
	 * appels aux autoloadder
	 */
	public static function load(){
		//session_start();
		require ROOT . '/app/Autoloader.php';
		App\Autoloader::register();
		require ROOT . '/core/Autoloader.php';
		Core\Autoloader::register();
	}

	/**
	 * récupère 1 instance de la classe dont le nom est fourni en paramètre
	 * @param $name 
	 * @return 
	 */
	public function getTable($name){		// DP: Factory
		$class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';
		return new $class_name($this->getDb());
	}

	/**
	 * récupère une connexion à la bdd
	 * @return 
	 */
	public function getDb(){
		$config = Config::getInstance(ROOT . '/config/config.php');
		if(is_null($this->db_instance)) {
			$this->db_instance = new MySQLDatabase($config->get('db_name'),$config->get('db_user'),$config->get('db_pass'),$config->get('db_host'));
		}
		return $this->db_instance;
	}

	

}