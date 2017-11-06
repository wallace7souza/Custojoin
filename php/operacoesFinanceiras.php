<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);
//print_r($data);
$opcao = $data->opcao;


switch ($opcao) {
	case 'Cadastrar Operação Financeira':

		$operacao = $data->operacao;
		$valor = $data->valor;
		$idempresa = $data->idempresa;
		$data = $data->data;
		
		//echo $operacao.'-'.$valor.'-'.$data.'-'.$idempresa;

		$insereOperacaoFinanceira=$pdo->prepare("INSERT INTO operacoesFinanceiras (idoperacoesFinanceiras, idempresa, data, operacao, valor) VALUES (?, ?, ?, ?, ?)");
		$insereOperacaoFinanceira->bindValue(1, NULL);
		$insereOperacaoFinanceira->bindValue(2, $idempresa);
		$insereOperacaoFinanceira->bindValue(3, $data);
		$insereOperacaoFinanceira->bindValue(4, $operacao);
		$insereOperacaoFinanceira->bindValue(5, $valor);

		$insereOperacaoFinanceira->execute();

		break;

	case 'Buscar Operação Financeira':
		
		$idempresa = $data->idempresa;

		$buscarOperacoesFinanceiras=$pdo->prepare("SELECT * FROM operacoesFinanceiras WHERE idempresa=:idempresa");
		$buscarOperacoesFinanceiras->bindValue(":idempresa", $idempresa);
		$buscarOperacoesFinanceiras->execute();

		while ($linha=$buscarOperacoesFinanceiras->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['data']);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];
			$operacao = $linha['operacao'];

			$return[] = array(
				'idoperacoesFinanceiras' => $linha['idoperacoesFinanceiras'],
				'operacao' => $operacao,
				'data' => $data,
				'valor' => $linha['valor']
			);

		}

		echo json_encode($return);

		break;

	case 'Buscar Operações Financeiras para editar':
		
		$idempresa = $data->idempresa;
		$idoperacoesFinanceiras = $data->idoperacoesFinanceiras;

		$buscarOperacoesFinanceiras=$pdo->prepare("SELECT * FROM operacoesFinanceiras WHERE idempresa=:idempresa AND idoperacoesFinanceiras=:idoperacoesFinanceiras");
		$buscarOperacoesFinanceiras->bindValue(":idempresa", $idempresa);
		$buscarOperacoesFinanceiras->bindValue(":idoperacoesFinanceiras", $idoperacoesFinanceiras);
		$buscarOperacoesFinanceiras->execute();

		$return = array();

		while ($linha=$buscarOperacoesFinanceiras->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['data']);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];
			$operacao = $linha['operacao'];

			$return = array(
				'idoperacoesFinanceiras' => $linha['idoperacoesFinanceiras'],
				'operacao' => $operacao,
				'data' => $data,
				'valor' => $linha['valor']
			);

		}

		echo json_encode($return);

		break;

	case 'Atualizar Operações Financeiras':
		
		$idempresa = $data->idempresa;
		$idoperacoesFinanceiras = $data->idoperacoesFinanceiras;
		$operacao = $data->operacao;
		$valor = $data->valor;
		$data = $data->data;

		$dataP = explode('/', $data);
		$data = $dataP[2].'-'.$dataP[0].'-'.$dataP[1];
		//echo $idempresa.'-'.$idoperacoesFinanceiras.'-'.$operacao.'-'.$valor.'-'.$data;

		$atualizarOperacoesFinanceiras=$pdo->prepare("UPDATE operacoesFinanceiras SET operacao=:operacao, valor=:valor, data=:data WHERE idempresa=:idempresa AND idoperacoesFinanceiras=:idoperacoesFinanceiras");
		$atualizarOperacoesFinanceiras->bindValue(":idempresa", $idempresa);
		$atualizarOperacoesFinanceiras->bindValue(":idoperacoesFinanceiras", $idoperacoesFinanceiras);
		$atualizarOperacoesFinanceiras->bindValue(":operacao", $operacao);
		$atualizarOperacoesFinanceiras->bindValue(":valor", $valor);
		$atualizarOperacoesFinanceiras->bindValue(":data", $data);
		$atualizarOperacoesFinanceiras->execute();

		break;

	default:
	# code...
		break;

}





?>