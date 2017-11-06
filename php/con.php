<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

function conectar(){
	
	try {
		$opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		//$pdo = new PDO("mysql:host=localhost;dbname=fluxojoinbd;", "root", "root", $opcoes);
		$pdo = new PDO("mysql:host=localhost;dbname=fluxojoinbd2;", "root", "root", $opcoes);
	} catch (Exception $e) {
		echo $e->getMessage();
	}

	return $pdo;

}

conectar();

?>