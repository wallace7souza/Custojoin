<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];
$idconta = $_GET['idconta'];

$buscaContaEntrada=$pdo->prepare('SELECT * FROM conta WHERE empresa_idempresa=:idempresa AND idconta=:idconta');
$buscaContaEntrada->bindValue('idempresa', $idempresa);
$buscaContaEntrada->bindValue('idconta', $idconta);
$buscaContaEntrada->execute();


while ($linha=$buscaContaEntrada->fetch(PDO::FETCH_ASSOC)) {

	$idsubcate = $linha['subcategoria_idsubcategoria'];


	$buscaSubcate=$pdo->prepare('SELECT subcategoria FROM subcategoria WHERE idsubcategoria=:idsubcate');
	$buscaSubcate->bindValue('idsubcate', $idsubcate);
	$buscaSubcate->execute();

	while ($linhaIdSubcate=$buscaSubcate->fetch(PDO::FETCH_ASSOC)) {

		$return = array(
			'idempresa' => $idempresa,
			'idconta' => $linha['idconta'],
			'conta'	=> utf8_encode($linha['conta']),
			'tipo' => utf8_encode($linhaIdSubcate['subcategoria'])
		);
	}

}

//print_r($return);
echo json_encode($return);