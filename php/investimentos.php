<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

$opcao = $data->opcao;


switch ($opcao) {
	case 'Cadastrar investimento':

		$invest = $data->invest;
		$valor = $data->valor;
		$idempresa = $data->idempresa;
		$data = $data->dataFormatada;

		$invest = utf8_decode($invest);
		
		//echo $invest.'-'.$valor.'-'.$data.'-'.$idempresa;

		$insereInvestimento=$pdo->prepare("INSERT INTO investimento (idinvestimento, idempresa, investimento, valor, data) VALUES (?, ?, ?, ?, ?)");
		$insereInvestimento->bindValue(1, NULL);
		$insereInvestimento->bindValue(2, $idempresa);
		$insereInvestimento->bindValue(3, $invest);
		$insereInvestimento->bindValue(4, $valor);
		$insereInvestimento->bindValue(5, $data);

		$insereInvestimento->execute();

		break;

	case 'Buscar investimento':
		
		$idempresa = $data->idempresa;
		//echo $idempresa;

		$buscarInvestimento=$pdo->prepare("SELECT * FROM investimento WHERE idempresa=:idempresa");
		$buscarInvestimento->bindValue(":idempresa", $idempresa);
		$buscarInvestimento->execute();

		while ($linha=$buscarInvestimento->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['data']);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];

			$return[] = array(
				'idinvestimento' => $linha['idinvestimento'],
				'investimento' => $linha['investimento'],
				'data' => $data,
				'valor' => $linha['valor']
			);

		}

		echo json_encode($return);

		break;

	case 'Buscar Investimento para editar':
		
		$idempresa = $data->idempresa;
		$idinvestimento = $data->idinvestimento;
		//echo $idempresa;

		$buscarInvestimento=$pdo->prepare("SELECT * FROM investimento WHERE idempresa=:idempresa AND idinvestimento=:idinvestimento");
		$buscarInvestimento->bindValue(":idempresa", $idempresa);
		$buscarInvestimento->bindValue(":idinvestimento", $idinvestimento);
		$buscarInvestimento->execute();

		$return = array();

		while ($linha=$buscarInvestimento->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['data']);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];

			$return = array(
				'idinvestimento' => $linha['idinvestimento'],
				'investimento' => $linha['investimento'],
				'data' => $data,
				'valor' => $linha['valor']
			);

		}

		echo json_encode($return);

		break;

	case 'Atualizar Investimento':
		
		$idempresa = $data->idempresa;
		$idinvestimento = $data->idinvestimento;
		$investimento = $data->investimento;
		$valor = $data->valor;
		$data = $data->data;

		$dataP = explode('/', $data);
		$data = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];

		//echo $idempresa.'-'.$idinvestimento.'-'.$investimento.'-'.$valor.'-'.$data;

		$atualizarInvestimento=$pdo->prepare("UPDATE investimento SET investimento=:investimento, valor=:valor, data=:data WHERE idempresa=:idempresa AND idinvestimento=:idinvestimento");
		$atualizarInvestimento->bindValue(":idempresa", $idempresa);
		$atualizarInvestimento->bindValue(":idinvestimento", $idinvestimento);
		$atualizarInvestimento->bindValue(":investimento", $investimento);
		$atualizarInvestimento->bindValue(":valor", $valor);
		$atualizarInvestimento->bindValue(":data", $data);
		$atualizarInvestimento->execute();

		break;

	default:
	# code...
		break;

}





?>