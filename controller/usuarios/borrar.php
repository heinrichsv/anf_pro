<?php

include("../../model/conexion.php");
include("funciones.php");

if(isset($_POST["id_usuario"]))
{
	$imagen = obtener_nombre_imagen($_POST["id_usuario"]);
	if($imagen != '')
	{
		unlink("img/" . $imagen);
	}
	$stmt = $conexion->prepare(
		"DELETE FROM usuarios WHERE id_usuario = :id_usuario"
	);
	$resultado = $stmt->execute(
		array(
			':id_usuario'	=>	$_POST["id_usuario"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Registro borrado';
	}
}



?>