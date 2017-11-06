<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];
$idcontaSaida = $_GET['idcontaSaida'];

$exibeContasSaida=$pdo->prepare('SELECT * FROM contaSaida WHERE conta_empresa_idempresa=:idempresa AND idcontaSaida=:idcontaSaida');
$exibeContasSaida->bindValue('idempresa', $idempresa);
$exibeContasSaida->bindValue('idcontaSaida', $idcontaSaida);
$exibeContasSaida->execute();

$return = array();

while ($linha=$exibeContasSaida->fetch(PDO::FETCH_ASSOC)) {

	$idsubcategoria = $linha['conta_subcategoria_idsubcategoria'];
	$idconta = $linha['conta_idconta'];

	$pegaSaida=$pdo->prepare('SELECT conta FROM conta WHERE idconta=:idconta');
	$pegaSaida->bindValue('idconta', $idconta);
	$pegaSaida->execute();

	while ($linhaSaida=$pegaSaida->fetch(PDO::FETCH_ASSOC)) {
		$saida = utf8_encode($linhaSaida['conta']);
	}

	$pegaSubcategoria=$pdo->prepare('SELECT subcategoria FROM subcategoria WHERE idsubcategoria=:idsubcategoria');
	$pegaSubcategoria->bindValue('idsubcategoria', $idsubcategoria);
	$pegaSubcategoria->execute();

	while ($linhaSubcate=$pegaSubcategoria->fetch(PDO::FETCH_ASSOC)) {

		$subcategoria = utf8_encode($linhaSubcate['subcategoria']);

		$return[] = array(
			'idconta' => $idconta,
			'saida' => $saida,
			'idcontaSaida' => $linha['idcontaSaida'],
			'subcategoria' => $subcategoria,
			'idsubcategoria' => $idsubcategoria,
			'valor' => $linha['valor'],
			'data' => $linha['data']
		);
	}
}

echo json_encode($return);