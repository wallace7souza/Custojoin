<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);
//print_r($data);

$idconta = $data->idconta;
$idcontaSaida = $data->idcontaSaida;
$idsubcategoria = $data->idsubcategoria;
$valor = $data->valor;
$idempresa = $data->idempresa;
$data = $data->data;



$atualizaContaEntrada=$pdo->prepare('UPDATE contaSaida SET conta_idconta=:idconta, valor=:valor, data=:data, conta_subcategoria_idsubcategoria=:idsubcategoria WHERE conta_empresa_idempresa=:idempresa AND idcontaSaida=:idcontaSaida');

$atualizaContaEntrada->bindValue('idconta', $idconta);
$atualizaContaEntrada->bindValue('idcontaSaida', $idcontaSaida);
$atualizaContaEntrada->bindValue('idempresa', $idempresa);
$atualizaContaEntrada->bindValue('idsubcategoria', $idsubcategoria);
//$atualizaContaEntrada->bindValue('contaSaida', $contaSaida);
$atualizaContaEntrada->bindValue('valor', $valor);
$atualizaContaEntrada->bindValue('data', $data);
$atualizaContaEntrada->execute();

$return = array(
	'msgAtualContaSucesso' => "Saida atualizada com sucesso!"
);

echo json_encode($return);
