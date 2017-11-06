<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$opcao = $data->opcao;


switch ($opcao) {
	case 'Cadastrar Operações de Autoliquidez':

		$autoliquidez = $data->Autoliquidez;
		$valor = $data->valor;
		$idempresa = $data->idempresa;
		$data = $data->data;

		//echo $Autoliquidez.'-'.$valor.'-'.$data.'-'.$idempresa;

		$insereOperacoesAutoliquidez=$pdo->prepare("INSERT INTO operacoesAutoliquidez (idoperacoesAutoliquidez, idempresa, autoliquidez, data, valor) VALUES (?, ?, ?, ?, ?)");
		$insereOperacoesAutoliquidez->bindValue(1, NULL);
		$insereOperacoesAutoliquidez->bindValue(2, $idempresa);
		$insereOperacoesAutoliquidez->bindValue(3, $autoliquidez);
		$insereOperacoesAutoliquidez->bindValue(4, $data);
		$insereOperacoesAutoliquidez->bindValue(5, $valor);

		$insereOperacoesAutoliquidez->execute();

		break;

	case 'Buscar Operações de Autoliquidez':
		
		$idempresa = $data->idempresa;

		$buscarOperacoesAutoliquidez=$pdo->prepare("SELECT * FROM operacoesAutoliquidez WHERE idempresa=:idempresa");
		$buscarOperacoesAutoliquidez->bindValue(":idempresa", $idempresa);
		$buscarOperacoesAutoliquidez->execute();

		while ($linha=$buscarOperacoesAutoliquidez->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['data']);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];
			$autoliquidez = $linha['autoliquidez'];

			$return[] = array(
				'idoperacoesAutoliquidez' => $linha['idoperacoesAutoliquidez'],
				'autoliquidez' => $autoliquidez,
				'data' => $data,
				'valor' => $linha['valor']
			);

		}

		echo json_encode($return);

		break;

	case 'Buscar Operações Autoliquidez para editar':
		
		$idempresa = $data->idempresa;
		$idoperacoesAutoliquidez = $data->idoperacoesAutoliquidez;

		$buscarOperacoesAutoliquidez=$pdo->prepare("SELECT * FROM operacoesAutoliquidez WHERE idempresa=:idempresa AND idoperacoesAutoliquidez=:idoperacoesAutoliquidez");
		$buscarOperacoesAutoliquidez->bindValue(":idempresa", $idempresa);
		$buscarOperacoesAutoliquidez->bindValue(":idoperacoesAutoliquidez", $idoperacoesAutoliquidez);
		$buscarOperacoesAutoliquidez->execute();

		$return = array();

		while ($linha=$buscarOperacoesAutoliquidez->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['data']);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];
			$autoliquidez = $linha['autoliquidez'];

			$return = array(
				'idoperacoesAutoliquidez' => $linha['idoperacoesAutoliquidez'],
				'autoliquidez' => $autoliquidez,
				'data' => $data,
				'valor' => $linha['valor']
			);

		}

		echo json_encode($return);

		break;

	case 'Atualizar Operações Autoliquidez':
		
		$idempresa = $data->idempresa;
		$idoperacoesAutoliquidez = $data->idoperacoesAutoliquidez;
		$autoliquidez = $data->autoliquidez;
		$valor = $data->valor;
		$data = $data->data;

		$dataP = explode('/', $data);
		$data = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];

		$atualizarOperacoesAutoliquidez=$pdo->prepare("UPDATE operacoesAutoliquidez SET autoliquidez=:autoliquidez, valor=:valor, data=:data WHERE idempresa=:idempresa AND idoperacoesAutoliquidez=:idoperacoesAutoliquidez");
		$atualizarOperacoesAutoliquidez->bindValue(":idempresa", $idempresa);
		$atualizarOperacoesAutoliquidez->bindValue(":idoperacoesAutoliquidez", $idoperacoesAutoliquidez);
		$atualizarOperacoesAutoliquidez->bindValue(":autoliquidez", $autoliquidez);
		$atualizarOperacoesAutoliquidez->bindValue(":valor", $valor);
		$atualizarOperacoesAutoliquidez->bindValue(":data", $data);
		$atualizarOperacoesAutoliquidez->execute();

		break;

	default:
	# code...
		break;

}





?>