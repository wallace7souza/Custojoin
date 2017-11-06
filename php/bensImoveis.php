<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include_once("con.php");

$pdo = conectar();

$data = file_get_contents("php://input");
$data = json_decode($data);

@$opcao = $data->opcao;


switch ($opcao) {
	case 'Cadastrar Bem':

		$titulo = $data->titulo;
		$valorBem = $data->valorBem;
		$valorRes = $data->valorRes;
		$dataAquisicao = $data->dataAquisicao;
		$numero = $data->numero;
		$periodo = $data->periodo;
		$idempresa = $data->idempresa;
		$titulo = utf8_decode($titulo);

		$insereBemImovel=$pdo->prepare("INSERT INTO bensimoveis (idbensimoveis, idempresa, bemimovel, dataAquisicao, valor, valorResidual, numero, periodo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$insereBemImovel->bindValue(1, NULL);
		$insereBemImovel->bindValue(2, $idempresa);
		$insereBemImovel->bindValue(3, $titulo);
		$insereBemImovel->bindValue(4, $dataAquisicao);
		$insereBemImovel->bindValue(5, $valorBem);
		$insereBemImovel->bindValue(6, $valorRes);
		$insereBemImovel->bindValue(7, $numero);
		$insereBemImovel->bindValue(8, $periodo);
		$insereBemImovel->execute();

		break;

	case 'Buscar Bem':
		
		$idempresa = $data->idempresa;

		$buscarBemImovel=$pdo->prepare("SELECT * FROM bensimoveis WHERE idempresa=:idempresa");
		$buscarBemImovel->bindValue(":idempresa", $idempresa);
		$buscarBemImovel->execute();

		while ($linha=$buscarBemImovel->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['dataAquisicao']);
			$dataAquisicao = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];

			$return[] = array(
				'idbensimoveis' => $linha['idbensimoveis'],
				'bemimovel' => $linha['bemimovel'],
				'dataAquisicao' => $dataAquisicao,
				'valor' => $linha['valor'],
				'valorResidual' => $linha['valorResidual'],
				'numero' => $linha['numero'],
				'periodo' => $linha['periodo']
			);

		}

		echo json_encode($return);

		break;

	case 'Buscar Bem Imóvel para editar':
		
		$idempresa = $data->idempresa;
		$idbensimoveis = $data->idbensimoveis;

		$buscarBemImovel=$pdo->prepare("SELECT * FROM bensimoveis WHERE idempresa=:idempresa AND idbensimoveis=:idbensimoveis");
		$buscarBemImovel->bindValue(":idempresa", $idempresa);
		$buscarBemImovel->bindValue(":idbensimoveis", $idbensimoveis);
		$buscarBemImovel->execute();

		$return = array();

		while ($linha=$buscarBemImovel->fetch(PDO::FETCH_ASSOC)) {

			$dataP = explode('-', $linha['dataAquisicao']);
			$dataAquisicao = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];

			$return = array(
				'idbensimoveis' => $linha['idbensimoveis'],
				'bemimovel' => $linha['bemimovel'],
				'dataAquisicao' => $dataAquisicao,
				'valor' => $linha['valor'],
				'valorResidual' => $linha['valorResidual'],
				'numero' => $linha['numero'],
				'periodo' => $linha['periodo']
			);

		}

		echo json_encode($return);

		break;

	case 'Atualizar Bem Imóvel':
		
		$idempresa = $data->idempresa;
		$idbensimoveis = $data->idbensimoveis;
		$bemimovel = $data->bemimovel;
		$dataAquisicao = $data->dataAquisicao;
		$valor = $data->valor;
		$valorResidual = $data->valorResidual;
		$numero = $data->numero;
		$periodo = $data->periodo;

		$dataP = explode('/', $dataAquisicao);
		$dataAquisicao = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];

		$insereAtualizacao=$pdo->prepare("UPDATE bensimoveis SET bemimovel=:bemimovel, dataAquisicao=:dataAquisicao, valor=:valor, valorResidual=:valorResidual, numero=:numero, periodo=:periodo WHERE idempresa=:idempresa AND idbensimoveis=:idbensimoveis");
		$insereAtualizacao->bindValue(":idempresa", $idempresa);
		$insereAtualizacao->bindValue(":idbensimoveis", $idbensimoveis);
		$insereAtualizacao->bindValue(":bemimovel", $bemimovel);
		$insereAtualizacao->bindValue(":dataAquisicao", $dataAquisicao);
		$insereAtualizacao->bindValue(":valor", $valor);
		$insereAtualizacao->bindValue(":valorResidual", $valorResidual);
		$insereAtualizacao->bindValue(":numero", $numero);
		$insereAtualizacao->bindValue(":periodo", $periodo);
		$insereAtualizacao->execute();

		break;

	default:
	# code...
		break;

}





?>