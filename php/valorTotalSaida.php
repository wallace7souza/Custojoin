<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];
$valorTotalSaida = 0;

$exibeValorTotalSaida=$pdo->prepare('SELECT valor FROM contaSaida WHERE conta_empresa_idempresa=:idempresa');
$exibeValorTotalSaida->bindValue('idempresa', $idempresa);
$exibeValorTotalSaida->execute();

$return = array();

while ($linha=$exibeValorTotalSaida->fetch(PDO::FETCH_ASSOC)) {

	$valorTotalSaida = $valorTotalSaida + $linha['valor'];

	$return = array(
		'valorTotalSaida' => $valorTotalSaida
	);
}
//echo $valorTotalEntrada;
echo json_encode($return);