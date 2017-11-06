<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idempresa = $_GET['idempresa'];

$tipo = "Recebimento";
$carregaContaEntrada=$pdo->prepare("SELECT * FROM conta WHERE tipo=:tipo AND empresa_idempresa=:idempresa");
$carregaContaEntrada->BindValue("idempresa", $idempresa);
$carregaContaEntrada->BindValue("tipo", $tipo);
$carregaContaEntrada->execute();

$return = array();

while ($linha=$carregaContaEntrada->fetch(PDO::FETCH_ASSOC)) {

	$return[] = array(
		'idconta' => $linha['idconta'],
		'conta'	=> utf8_encode($linha['conta'])
	);
}

echo json_encode($return);