<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$idusuario = $data->idusuario;

$buscaUsuario=$pdo->prepare('SELECT * FROM usuario WHERE idusuario=:idusuario');
$buscaUsuario->bindValue('idusuario', $idusuario);
$buscaUsuario->execute();

$return = array();

while ($linha=$buscaUsuario->fetch(PDO::FETCH_ASSOC)) {

	$return[] = array(
		'idempresa'	=> $linha['empresa_idempresa'],
		'idusuario'	=> $linha['idusuario'],
		'usuario'	=> utf8_encode($linha['usuario']),
		'senha'	=> $linha['senha'],
		'email'	=> $linha['email'],
		'nome'	=> $linha['nome'],
	);
}

echo json_encode($return);