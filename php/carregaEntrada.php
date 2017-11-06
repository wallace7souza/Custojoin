<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];
$idcontaEntrada = $_GET['idcontaEntrada'];

$exibeContasEntrada=$pdo->prepare('SELECT * FROM contaEntrada WHERE conta_empresa_idempresa=:idempresa AND idcontaEntrada=:idcontaEntrada');
$exibeContasEntrada->bindValue('idempresa', $idempresa);
$exibeContasEntrada->bindValue('idcontaEntrada', $idcontaEntrada);
$exibeContasEntrada->execute();

$return = array();

while ($linha=$exibeContasEntrada->fetch(PDO::FETCH_ASSOC)) {

	$idsubcategoria = $linha['conta_subcategoria_idsubcategoria'];
	$idconta = $linha['conta_idconta'];

	$pegaEntrada=$pdo->prepare('SELECT conta FROM conta WHERE idconta=:idconta');
	$pegaEntrada->bindValue('idconta', $idconta);
	$pegaEntrada->execute();

	while ($linhaEntrada=$pegaEntrada->fetch(PDO::FETCH_ASSOC)) {
		$entrada = utf8_encode($linhaEntrada['conta']);
	}

	$pegaSubcategoria=$pdo->prepare('SELECT subcategoria FROM subcategoria WHERE idsubcategoria=:idsubcategoria');
	$pegaSubcategoria->bindValue('idsubcategoria', $idsubcategoria);
	$pegaSubcategoria->execute();

	while ($linhaSubcate=$pegaSubcategoria->fetch(PDO::FETCH_ASSOC)) {

		$subcategoria = $linhaSubcate['subcategoria'];

		$return[] = array(
			'idconta' => $idconta,
			'entrada' => $entrada,
			'idcontaEntrada' => $linha['idcontaEntrada'],
			'subcategoria' => $subcategoria,
			'idsubcategoria' => $idsubcategoria,
			'valor' => $linha['valor'],
			'data' => $linha['data']
		);
	}
}

echo json_encode($return);