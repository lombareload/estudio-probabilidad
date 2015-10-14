<?php
require_once ("conexion.inc.php");

$gbd = Conexion::getConexionPDO();

$numForm = isset($_GET['numForm']) ? $_GET['numForm'] : '';	

if($numForm != ''){
	$consulta = "SELECT idformu,contexto,situacion,tiempo FROM `formulario` WHERE idformu = :numForm LIMIT 1 ";

	$sentencia = $gbd->prepare($consulta);
	$result = $sentencia->execute(array(':numForm' => $numForm));
	$data = $sentencia->fetch(PDO::FETCH_ASSOC);
	
	$consulta = "SELECT pregunta,opcion1,opcion2 from caso WHERE idFormulario = :numForm";
	$sentencia = $gbd->prepare($consulta);
	$resultCasos = $sentencia->execute(array(':numForm' => $numForm));
	$dataCasos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
	
	if($result && $resultCasos){
		echo json_encode(array_merge($data, $dataCasos));
	}
	
}else{
	
	echo array('error' => 'error');
}
	
?>