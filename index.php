<?php
	require_once "rotas.php";
	spl_autoload_register(function($class){
		if(file_exists('Controllers/' . $class . '.php'))
		{
			require_once 'Controllers/' . $class . '.php';
		}
		else if(file_exists('Models/' . $class . '.php'))
		{
			require_once 'Models/' . $class . '.php';
		}
		else if(file_exists('Models/DAO/' . $class . '.php'))
		{
			require_once 'Models/DAO/' . $class . '.php';
		}
		else if(file_exists('Conexao/' . $class . '.php'))
		{
			require_once 'Conexao/' . $class . '.php';
		}
		else
		{
			die("Arquivo não existe " . $class);
		}
	});
	
	//rotas
	$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
	$uri = substr($uri, strpos($uri,'/',1));
	$route->verificar_rota($_SERVER["REQUEST_METHOD"],$uri);

?>