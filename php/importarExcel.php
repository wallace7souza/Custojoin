<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

header("Access-Control-Allow-Methods", "POST, PUT, OPTIONS");
header("Access-Control-Allow-Origin", "*.*");
header("Access-Control-Allow-Headers", "Content-Type");

include_once("con.php");

$pdo = conectar();

include_once("PHPExcel/Classes/PHPExcel.php");

$uploadDir = "uploadFile/";

/*$uploadfile = $uploadDir . $_FILES['arquivo']['name'];
$id_empresa = $_POST['id_empresa'];*/

if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
	echo "Dados pegos com sucesso.";
}else{
	echo "Não foi possível pegar arquivo";
}


//Verifica se já existem dados na seguinte tabela
/*$qryQuant = "SELECT * FROM dadosImportados";
$resQ = mysqli_query($con,$qryQuant);
$quant = mysqli_num_rows($resQ); // verifica se tem dados na tabela dadosImportados, fazendo contagem de linhas.

if($quant > 0){ // se tiver dados no banco, apaga tudo
	$qryZera = "DELETE FROM dadosImportados";
	mysqli_query($con,$qryZera);
}*/


$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load($uploadfile);

$sheet = $objPHPExcel->getActiveSheet();

foreach ($sheet->rangeToArray($sheet->calculateWorksheetDataDimension()) as $row) {

	$qry=$pdo->prepare("INSERT INTO dadosImportados (id, id_empresa, lin0,lin1,lin2, lin3)");
	$qry->bindValue(1, NULL);
	$qry->bindValue(2, $id_empresa);
	$qry->bindValue(3, $row[0]);
	$qry->bindValue(4, $row[1]);
	$qry->bindValue(5, $row[2]);
	$qry->bindValue(6, $row[3]);
	$qry->execute();

	//$qry = "INSERT INTO dadosImportados VALUES(NULL,'$id_empresa','$row[0]','$row[1]','$row[2]','$row[3]')";
}

	/*$qryInsert=$pdo->prepare("SELECT * FROM dadosImportados");// busca os dados na tabela dadosImportados
	$qryInsert->execute();

	$dia = date('Y'); // pega o ano atual

	while($row = mysqli_fetch_array($res)){
		$data = $row['data'];
		$valor = $row['valor'];
		$tipo = $row['tipo'];
		$descricao = $row['descricao'];

		$dataP = explode('-', $data);
		$data = $dia.'-'.$dataP[1].'-'.$dataP[0];
		$valor = floatval(str_replace(',', '.', str_replace('.', '', $valor)));

		//echo $data.' '.$tipo.' '.$valor.' '.$descricao.'<br>';
		$qryNovoInsert = "INSERT INTO importa VALUES(NULL,'$id_empresa','$data','$tipo','$valor','$descricao')";
		mysqli_query($con,$qryNovoInsert);

	}
	echo "Importação feita com sucesso.";*/

}

?>
<a class="btn btn-default" href="../#/importacao">Voltar</a>
</body>
</html>