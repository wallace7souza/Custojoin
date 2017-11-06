<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];

$exibeContasEntrada=$pdo->prepare('SELECT * FROM contaEntrada WHERE conta_empresa_idempresa=:idempresa');
$exibeContasEntrada->bindValue('idempresa', $idempresa);
$exibeContasEntrada->execute();

while ($linha=$exibeContasEntrada->fetch(PDO::FETCH_ASSOC)) {

	$idsubcategoria = $linha['conta_subcategoria_idsubcategoria'];
	$conta_idconta = $linha['conta_idconta'];
	$idcontaEntrada = $linha['idcontaEntrada'];

	$trocaIdPorNome=$pdo->prepare("SELECT conta FROM conta WHERE idconta=:idconta");
	$trocaIdPorNome->bindValue("idconta", $conta_idconta);
	$trocaIdPorNome->execute();

	while ($linhaNome=$trocaIdPorNome->fetch(PDO::FETCH_ASSOC)) {
		$conta = $linhaNome['conta'];
	}

	$data = $linha['data'];
	$data1 = explode('-', $data);
	$data = $data1[2].'/'.$data1[1].'/'.$data1[0];

	$pegaSubcategoria=$pdo->prepare('SELECT subcategoria FROM subcategoria WHERE idsubcategoria=:idsubcategoria');
	$pegaSubcategoria->bindValue('idsubcategoria', $idsubcategoria);
	$pegaSubcategoria->execute();

	while ($linhaSubcate=$pegaSubcategoria->fetch(PDO::FETCH_ASSOC)) {

		$subcategoria = $linhaSubcate['subcategoria'];

		$return[] = array(
			'data' => $data,
			'idconta' => $conta_idconta,
			'idsubcategoria' => $idsubcategoria,
			'idcontaEntrada' => $idcontaEntrada,
			'idempresa' => $idempresa,
			'subcategoria' => utf8_encode($linhaSubcate['subcategoria']),
			'entrada' => utf8_encode($conta),
			'valor' => $linha['valor'],
		);
	}
}
//print_r($return);
echo json_encode($return);