<?php

include("../../model/conexion.php");
include("funciones.php");

if(isset($_POST["id_depto"]))
{
	$stmt = $conexion->prepare(
		"DELETE FROM departamentos WHERE id_depto = :id_depto"
	);
	$resultado = $stmt->execute(
		array(
			':id_depto'	=>	$_POST["id_depto"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Registro borrado';
	}
}

?>