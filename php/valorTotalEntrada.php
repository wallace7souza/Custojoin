<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];
$valorTotalEntrada = 0;

$exibeValorTotalEntrada=$pdo->prepare('SELECT valor FROM contaEntrada WHERE conta_empresa_idempresa=:idempresa');
$exibeValorTotalEntrada->bindValue('idempresa', $idempresa);
$exibeValorTotalEntrada->execute();

$return = array();

while ($linha=$exibeValorTotalEntrada->fetch(PDO::FETCH_ASSOC)) {

	$valorTotalEntrada = $valorTotalEntrada + $linha['valor'];

	$return = array(
		'valorTotalEntrada' => $valorTotalEntrada
	);
}
//echo $valorTotalEntrada;
echo json_encode($return);