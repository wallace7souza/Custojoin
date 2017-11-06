<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idcontaSaida = $_GET['idcontaSaida'];

$carregaSaidaEdicao=$pdo->prepare('SELECT * FROM contaSaida WHERE idcontaSaida=:idcontaSaida');
$carregaSaidaEdicao->bindValue('idcontaSaida', $idcontaSaida);
$carregaSaidaEdicao->execute();

$return = array();

while ($linha=$carregaSaidaEdicao->fetch(PDO::FETCH_ASSOC)) {

	$valor = $linha['valor'];
	$data = $linha['data'];
	$idconta = $linha['conta_idconta'];
	$idsubcategoria = $linha['conta_subcategoria_idsubcategoria'];


	$return = array(
		'idcontaSaida' => $idcontaSaida,
		'idconta' => $idconta,
		//'conta' => utf8_encode($conta),
		'idsubcategoria' => $idsubcategoria,
		//'subcategoria' => $subcategoria,
		'valor' => $valor,
		'data' => $data
	);
	
}

//print_r($return);

echo json_encode($return);