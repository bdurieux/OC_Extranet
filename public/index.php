<?php
session_start();
define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';

App::load();

if(isset($_SESSION['auth'])){
	$home = "partners.index";
}else{
	$home = "users.login";
}

if(isset($_GET['p'])){
	$page = $_GET['p'];
}else{
	$page = $home;
}

$page = explode('.', $page);

if($page[0] == 'admin'){
	$controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
	$action = $page[2];
}else{
	$controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
	$action = $page[1];
}

$controller = new $controller();
$controller->$action();
try{
	//$controller->$action();
}catch(Throwable $t){
	header('Location: index.php?p=public.notFound');
}catch(Exception $e){
	header('Location: index.php?p=public.notFound');
}

