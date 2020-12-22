<?php
session_start();
define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';

App::load();

// définition de la page par défaut selon si l'utilisateur est connecté ou pas
if(isset($_SESSION['auth'])){
	$home = "partners.index";
}else{
	$home = "users.login";
}

//récupération des paramètres de l'url
if(isset($_GET['p'])){
	$page = $_GET['p'];
}else{
	$page = $home;
}

// 
$page = explode('.', $page);

if($page[0] == 'admin'){
	$controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
	$action = $page[2];
}else{
	$controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
	$action = $page[1];
}

$controller = new $controller();
//$controller->$action();
try{
	$controller->$action();
}catch(Throwable $t){		// php 7 only
	header('Location: index.php?p=public.notFound');
}catch(Exception $e){	// php 5 only
	header('Location: index.php?p=public.notFound');
}

