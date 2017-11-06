<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$idcategoria = $_GET['idcategoria'];

$buscaCategoria=$pdo->prepare('SELECT categoriaComum FROM categoriaComum WHERE idcategoriaComum=:idcategoriaComum');
$buscaCategoria->bindValue('idcategoriaComum', $idcategoria);
$buscaCategoria->execute();

$return = array();

while ($linha=$buscaCategoria->fetch(PDO::FETCH_ASSOC)) {

	$return[] = array(
		'categoriaComum'	=> utf8_encode($linha['categoriaComum']),
	);
}

echo json_encode($return);