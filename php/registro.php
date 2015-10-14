<?php
require_once ("conexion.inc.php");

$gbd = Conexion::getConexionPDO();

$email = isset($_POST['email']) ? $_POST['email'] : '';
$fecha = date("Y-m-d");
$horaInicio = date("H:i:s");  

/*echo $email;
echo '<br>';
echo $fecha;*/

if($email != ''){
	$consulta = "INSERT INTO `estudioprobabilidad`.`usuario` (`email`, `fechaReal`, `horaIni`) VALUES (?, ?, ?);";

	$sentencia = $gbd->prepare($consulta);
	$result = $sentencia->execute(array($email,$fecha,$horaInicio));

	if($result){
		echo 'success';
	}else{
	// email ya esta
		echo 'success';
	}
}else{
	
	echo 'error';
}

?>