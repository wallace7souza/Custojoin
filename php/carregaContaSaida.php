<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];
echo $idempresa;

$tipo = 'Pagamento';
$exibeContasSaida=$pdo->prepare('SELECT * FROM conta WHERE empresa_idempresa=:idempresa AND tipo=:tipo');
$exibeContasSaida->bindValue('idempresa', $idempresa);
$exibeContasSaida->bindValue('tipo', $tipo);
$exibeContasSaida->execute();

$return = array();

while ($linha=$exibeContasSaida->fetch(PDO::FETCH_ASSOC)) {

	$idsubcategoria = $linha['subcategoria_idsubcategoria'];
	$idconta = $linha['idconta'];
	$conta = utf8_encode($linha['conta']);

	$pegaSubcategoria=$pdo->prepare('SELECT subcategoria FROM subcategoria WHERE idsubcategoria=:idsubcategoria');
	$pegaSubcategoria->bindValue('idsubcategoria', $idsubcategoria);
	$pegaSubcategoria->execute();

	while ($linhaSubcate=$pegaSubcategoria->fetch(PDO::FETCH_ASSOC)) {

		$subcategoria = $linhaSubcate['subcategoria'];

		$return[] = array(
			'idconta' => $linha['idconta'],
			'conta' => utf8_encode($linha['conta']),
			'idsubcategoria' => $idsubcategoria
		);

	}

}

print_r($return);
//echo json_encode($return);