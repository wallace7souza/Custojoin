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
	case 'Cadastrar Pagamentos Diversos':

		$pagamento = $data->pagamento;
		$valor = $data->valor;
		$idempresa = $data->idempresa;
		$data = $data->data;
		
		//echo $pagamento.'-'.$valor.'-'.$data.'-'.$idempresa;

		$inserePagamentoDiversos=$pdo->prepare("INSERT INTO pagamentosDiversos (idpagamentosDiversos, idempresa, data, pagamento, valor) VALUES (?, ?, ?, ?, ?)");
		$inserePagamentoDiversos->bindValue(1, NULL);
		$inserePagamentoDiversos->bindValue(2, $idempresa);
		$inserePagamentoDiversos->bindValue(3, $data);
		$inserePagamentoDiversos->bindValue(4, $pagamento);
		$inserePagamentoDiversos->bindValue(5, $valor);

		$inserePagamentoDiversos->execute();

		break;

	case 'Buscar Pagamentos Diversos':
		
		$idempresa = $data->idempresa;
		//echo $idempresa;

		$buscarPagamentosDiversos=$pdo->prepare("SELECT * FROM pagamentosDiversos WHERE idempresa=:idempresa");
		$buscarPagamentosDiversos->bindValue(":idempresa", $idempresa);
		$buscarPagamentosDiversos->execute();

		while ($linha=$buscarPagamentosDiversos->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['data']);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];
			$pagamento = $linha['pagamento'];

			$return[] = array(
				'idpagamentosDiversos' => $linha['idpagamentosDiversos'],
				'pagamento' => $pagamento,
				'data' => $data,
				'valor' => $linha['valor']
			);

		}

		echo json_encode($return);

		break;

	case 'Buscar Pagamentos Diversos para editar':
		
		$idempresa = $data->idempresa;
		$idpagamentosDiversos = $data->idpagamentosDiversos;
		//echo $idempresa;

		$buscarPagamentosDiversos=$pdo->prepare("SELECT * FROM pagamentosDiversos WHERE idempresa=:idempresa AND idpagamentosDiversos=:idpagamentosDiversos");
		$buscarPagamentosDiversos->bindValue(":idempresa", $idempresa);
		$buscarPagamentosDiversos->bindValue(":idpagamentosDiversos", $idpagamentosDiversos);
		$buscarPagamentosDiversos->execute();

		$return = array();

		while ($linha=$buscarPagamentosDiversos->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['data']);
			$data = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];
			$pagamento = $linha['pagamento'];

			$return = array(
				'idpagamentosDiversos' => $linha['idpagamentosDiversos'],
				'pagamento' => $pagamento,
				'data' => $data,
				'valor' => $linha['valor']
			);

		}

		echo json_encode($return);

		break;

	case 'Atualizar Pagamentos Diversos':
		
		$idempresa = $data->idempresa;
		$idpagamentosDiversos = $data->idpagamentosDiversos;
		$pagamento = $data->pagamento;
		$valor = $data->valor;
		$data = $data->data;

		$dataP = explode('/', $data);
		$data = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];

		$atualizarPagamentosDiversos=$pdo->prepare("UPDATE pagamentosDiversos SET pagamento=:pagamento, valor=:valor, data=:data WHERE idempresa=:idempresa AND idpagamentosDiversos=:idpagamentosDiversos");
		$atualizarPagamentosDiversos->bindValue(":idempresa", $idempresa);
		$atualizarPagamentosDiversos->bindValue(":idpagamentosDiversos", $idpagamentosDiversos);
		$atualizarPagamentosDiversos->bindValue(":pagamento", $pagamento);
		$atualizarPagamentosDiversos->bindValue(":valor", $valor);
		$atualizarPagamentosDiversos->bindValue(":data", $data);
		$atualizarPagamentosDiversos->execute();

		break;

	default:
	# code...
		break;

}





?>