<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);
//print_r($data);

$idsubcategoria = $data->subcategoria;
$idconta = $data->idconta;
$valor = $data->valor;
$idempresa = $data->idempresa;

$dia = $data->data;
$diaP = explode('T', $dia);
$dia = $diaP[0];

$tipo = "";
//echo 'idsubcategoria '.$idsubcategoria.' idconta '.$idconta.' valor '.$valor.' data '.$dia.' idempresa '.$idempresa;

//INSERE A CONTA DE ENTRADA E SEUS RESPECTIVOS DADOS NO BANCO
$insereContaEntrada=$pdo->prepare("INSERT INTO contaEntrada (idcontaEntrada, valor, data, tipo, conta_idconta, conta_empresa_idempresa, conta_subcategoria_idsubcategoria)
								   VALUES(?, ?, ?, ?, ?, ?, ?)");
$insereContaEntrada->bindValue(1, NULL);
$insereContaEntrada->bindValue(2, $valor);
$insereContaEntrada->bindValue(3, $dia);
$insereContaEntrada->bindValue(4, NULL);
$insereContaEntrada->bindValue(5, $idconta);
$insereContaEntrada->bindValue(6, $idempresa);
$insereContaEntrada->bindValue(7, $idsubcategoria);

$insereContaEntrada->execute();

?>