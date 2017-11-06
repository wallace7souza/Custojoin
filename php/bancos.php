<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

@$opcao = $data->opcao;

if($data){
	$opcao = $data->opcao;
}else{
	$opcao = $_GET['opcao'];
}


switch ($opcao) {
	case 'Cadastrar':

		$agencia = $data->agencia;
		$conta = $data->conta;
		$banco = $data->nome;
		$idempresa = $data->idempresa;
		$banco = utf8_decode($banco);
		//print_r($agencia.'-'.$conta.'-'.$banco.'-'.$idempresa);

		$insereBanco=$pdo->prepare("INSERT INTO banco (idbanco, idempresa, banco, agencia, conta) VALUES (?, ?, ?, ?, ?)");
		$insereBanco->bindValue(1, NULL);
		$insereBanco->bindValue(2, $idempresa);
		$insereBanco->bindValue(3, $banco);
		$insereBanco->bindValue(4, $agencia);
		$insereBanco->bindValue(5, $conta);

		$insereBanco->execute();
		//$idempresa = $pdo->lastInsertId();

		$return = array(
			'status' => 200,
			'msg' => "Banco cadastrado com sucesso"
		);

		echo json_encode($return);

		break;

	case 'buscar':

		$idempresa = $_GET['idempresa'];

		$buscaBanco=$pdo->prepare("SELECT * FROM banco WHERE idempresa=:idempresa");
		$buscaBanco->bindValue(":idempresa", $idempresa);
		$buscaBanco->execute();

		while ($linha=$buscaBanco->fetch(PDO::FETCH_ASSOC)) {

			$return[] = array(
				'idbanco' => $linha['idbanco'],
				'banco' => $linha['banco'],
				'agencia' => $linha['agencia'],
				'conta' => $linha['conta']
			);

		}

		echo json_encode($return);

		break;

	case 'Buscar para edição':

		$idempresa = $_GET['idempresa'];
		$idbanco = $_GET['idbanco'];

		$buscaBanco=$pdo->prepare("SELECT * FROM banco WHERE idempresa=:idempresa AND idbanco=:idbanco");
		$buscaBanco->bindValue(":idempresa", $idempresa);
		$buscaBanco->bindValue(":idbanco", $idbanco);
		$buscaBanco->execute();

		while ($linha=$buscaBanco->fetch(PDO::FETCH_ASSOC)) {

			$return = array(
				'idbanco' => $linha['idbanco'],
				'nome' => $linha['banco'],
				'agencia' => $linha['agencia'],
				'conta' => $linha['conta']
			);

		}

		echo json_encode($return);

		break;

	case 'Buscar todos':

		$idempresa = $data->idempresa;

		$buscaBanco=$pdo->prepare("SELECT * FROM banco WHERE idempresa=:idempresa");
		$buscaBanco->bindValue(":idempresa", $idempresa);
		$buscaBanco->execute();

		while ($linha=$buscaBanco->fetch(PDO::FETCH_ASSOC)) {

			$return[] = array(
				'idbanco' => $linha['idbanco'],
				'banco' => $linha['banco']
			);

		}

		echo json_encode($return);

		break;

	case 'Adicionar saldo':
		
		$idempresa = $data->idempresa;
		$idbanco = $data->banco;
		$formaPgto = $data->formaPgto;
		$valor = $data->valor;
		$data = $data->data;

		$buscaNomeBanco=$pdo->prepare("SELECT banco FROM banco WHERE idbanco=:idbanco AND idempresa=:idempresa");
		$buscaNomeBanco->bindValue(":idbanco", $idbanco);
		$buscaNomeBanco->bindValue(":idempresa", $idempresa);
		$buscaNomeBanco->execute();

		while ($linhaNomeBanco=$buscaNomeBanco->fetch(PDO::FETCH_ASSOC)) {

			$banco = $linhaNomeBanco['banco'];

		}

		//echo $idempresa.$idbanco.$banco.$formaPgto.$valor.$data;

		$insereSaldo=$pdo->prepare("INSERT INTO contabanco (idsaldo, idbanco, banco, valor, data, formaPgto) VALUES(?, ?, ?, ? , ?, ?)");
		$insereSaldo->bindValue(1, NULL);
		$insereSaldo->bindValue(2, $idbanco);
		$insereSaldo->bindValue(3, $banco);
		$insereSaldo->bindValue(4, $valor);
		$insereSaldo->bindValue(5, $data);
		$insereSaldo->bindValue(6, $formaPgto);

		$insereSaldo->execute();

		break;

	case 'Buscar saldo':

		$buscarSaldos=$pdo->prepare("SELECT * FROM contabanco");
		$buscarSaldos->execute();

		while ($linhaSaldos=$buscarSaldos->fetch(PDO::FETCH_ASSOC)) {

			$data = $linhaSaldos['data'];
			$dataP = explode('-', $data);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];

			$saldo[] = array(
				'idsaldo' => $linhaSaldos['idsaldo'],
				'banco' => $linhaSaldos['banco'],
				'valor' => $linhaSaldos['valor'],
				'data' => $data,
				'formaPgto' => $linhaSaldos['formaPgto']
				);

		}

		echo json_encode($saldo);

		break;

	case 'Saldo total':

		$valor = 0;
		
		$buscarSaldoTotal=$pdo->prepare("SELECT valor FROM contabanco");
		$buscarSaldoTotal->execute();

		while ($linhaSaldoTotal=$buscarSaldoTotal->fetch(PDO::FETCH_ASSOC)) {

			$valor = $valor + $linhaSaldoTotal['valor'];

		}

		echo $valor;

		break;

	case 'Atualizar Banco':
		//print_r($data);

		$idbanco = $data->idbanco;
		$idempresa = $data->idempresa;
		$banco = $data->nome;
		$agencia = $data->agencia;
		$conta = $data->conta;
		
		$atualizarBanco=$pdo->prepare("UPDATE banco SET agencia=:agencia, conta=:conta, banco=:banco
										WHERE idempresa=:idempresa AND idbanco=:idbanco");
		$atualizarBanco->bindValue('idempresa', $idempresa);
		$atualizarBanco->bindValue('idbanco', $idbanco);
		$atualizarBanco->bindValue('agencia', $agencia);
		$atualizarBanco->bindValue('conta', $conta);
		$atualizarBanco->bindValue('banco', $banco);
		$atualizarBanco->execute();


	break;

	case 'Deletar':
		//print_r($data);

		$idbanco = $_GET['idbanco'];
		$idempresa = $_GET['idempresa'];
		
		$deletarBanco=$pdo->prepare("DELETE FROM banco WHERE idempresa=:idempresa AND idbanco=:idbanco");
		$deletarBanco->bindValue('idempresa', $idempresa);
		$deletarBanco->bindValue('idbanco', $idbanco);

		$deletarBanco->execute();


	break;
	
	default:
		# code...
		break;
}





?>