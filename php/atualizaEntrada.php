<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);
//print_r($data);

$idempresa = $data->idempresa;
$idconta = $data->idconta;
$idcontaEntrada = $data->idcontaEntrada;
$idsubcategoria = $data->idsubcategoria;
$valor = $data->valor;
$data = $data->data;


//echo ' idconta '.$idconta.' idcontaEntrada '.$idcontaEntrada.' idsubcategoria '.$idsubcategoria.' valor '.$valor.' data '.$data.' idempresa '.$idempresa;

$atualizaContaEntrada=$pdo->prepare('UPDATE contaEntrada SET conta_idconta=:idconta, valor=:valor, data=:data, conta_subcategoria_idsubcategoria=:idsubcategoria WHERE conta_empresa_idempresa=:idempresa AND idcontaEntrada=:idcontaEntrada');

$atualizaContaEntrada->bindValue('idconta', $idconta);
$atualizaContaEntrada->bindValue('idcontaEntrada', $idcontaEntrada);
$atualizaContaEntrada->bindValue('idempresa', $idempresa);
$atualizaContaEntrada->bindValue('idsubcategoria', $idsubcategoria);
$atualizaContaEntrada->bindValue('valor', $valor);
$atualizaContaEntrada->bindValue('data', $data);
$atualizaContaEntrada->execute();

$return = array(
	'msgSucesso' => "Entrada atualizada com sucesso!"
);

echo json_encode($return);
