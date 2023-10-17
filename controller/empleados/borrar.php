<?php

include("../../model/conexion.php");
include("funciones.php");

if(isset($_POST["id_empleado"]))
{

	$stmt = $conexion->prepare(
		"DELETE FROM empleados WHERE id_empleado = :id_empleado"
	);
	$resultado = $stmt->execute(
		array(
			':id_empleado'	=>	$_POST["id_empleado"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Registro borrado';
	}
}



?>