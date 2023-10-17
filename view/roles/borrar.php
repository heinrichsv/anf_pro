<?php

include("../../model/conexion.php");
include("funciones.php");

if(isset($_POST["id_rol"]))
{
	$stmt = $conexion->prepare(
		"DELETE FROM roles WHERE id_rol = :id_rol"
	);
	$resultado = $stmt->execute(
		array(
			':id_rol'	=>	$_POST["id_rol"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Registro borrado';
	}
}

?>