<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

header("Access-Control-Allow-Methods", "POST, PUT, OPTIONS");
header("Access-Control-Allow-Origin", "*.*");
header("Access-Control-Allow-Headers", "Content-Type");

include_once("con.php");
include_once("PHPExcel/Classes/PHPExcel.php");

$pdo = conectar();

$filename = $_FILES['file']['name'];
$meta = $_POST;
$destination = $meta['uploadFile'] . $filename;
move_uploaded_file( $_FILES['file']['tmp_name'] , $destination );


//$uploadDir = "uploadFile/";



}

?>
<a class="btn btn-default" href="../#/importacao">Voltar</a>
</body>
</html>