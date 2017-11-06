<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);
//print_r($data);

$idsubcategoria = $data->subcategoria;
$idempresa = $data->idempresa;
$idconta = $data->conta;
$valor = $data->valor;

$dia = $data->data;
$diaP = explode('T', $dia);
$dia = $diaP[0];

$tipo = "";

//echo ' idsubcategoria '.$idsubcategoria.' idempresa '.$idempresa.' idconta '.$idconta.' valor '.$valor.' data '.$dia;

$insereContaSaida=$pdo->prepare("INSERT INTO contaSaida (idcontaSaida, valor, data, tipo, conta_idconta, conta_empresa_idempresa, conta_subcategoria_idsubcategoria)
								   VALUES(?, ?, ?, ?, ?, ?, ?)");
$insereContaSaida->bindValue(1, NULL);
$insereContaSaida->bindValue(2, $valor);
$insereContaSaida->bindValue(3, $dia);
$insereContaSaida->bindValue(4, NULL);
$insereContaSaida->bindValue(5, $idconta);
$insereContaSaida->bindValue(6, $idempresa);
$insereContaSaida->bindValue(7, $idsubcategoria);
$insereContaSaida->execute();

?>