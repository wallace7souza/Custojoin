<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];

$tipo = "Pagamento";
$carregaContasSaida=$pdo->prepare("SELECT * FROM conta WHERE tipo=:tipo AND empresa_idempresa=:idempresa");
$carregaContasSaida->BindValue("idempresa", $idempresa);
$carregaContasSaida->BindValue("tipo", $tipo);
$carregaContasSaida->execute();

$return = array();

while ($linha=$carregaContasSaida->fetch(PDO::FETCH_ASSOC)) {

	$return[] = array(
		'idconta' => $linha['idconta'],
		'conta'	=> utf8_encode($linha['conta'])
	);
}

echo json_encode($return);