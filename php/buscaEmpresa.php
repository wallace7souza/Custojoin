<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$idempresa = $data->idempresa;

$buscaEmpresa=$pdo->prepare('SELECT * FROM empresa WHERE idempresa=:idempresa');
$buscaEmpresa->bindValue('idempresa', $idempresa);
$buscaEmpresa->execute();

$return = array();

while ($linha=$buscaEmpresa->fetch(PDO::FETCH_ASSOC)) {

	$return[] = array(
		'idempresa'	=> $linha['idempresa'],
		'empresa'	=> utf8_encode($linha['empresa']),
		'cnpj'	=> $linha['cnpj'],
		'endereco'	=> utf8_encode($linha['endereco']),
		'iestadual'	=> $linha['iestadual'],
		'telefone'	=> $linha['telefone'],
	);
}

echo json_encode($return);