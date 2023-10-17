<?php

include("../../model/conexion.php");
include("funciones.php");

if(isset($_POST["id_categoria"]))
{
	$stmt = $conexion->prepare(
		"DELETE FROM categorias WHERE id_categoria = :id"
	);
	$resultado = $stmt->execute(
		array(
			':id'	=>	$_POST["id_categoria"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Registro borrado';
	}
}

?>