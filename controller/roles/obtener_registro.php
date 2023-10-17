<?php

include("../../model/conexion.php");
include("funciones.php");

if (isset($_POST["id_rol"])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT id_rol, nombre, estado FROM roles WHERE id_rol = '".$_POST["id_rol"]."' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach($resultado as $fila){
        $salida["nombre"] = $fila["nombre"];
        $salida["estado"] = $fila["estado"];
        $salida["id_rol"] = $fila["id_rol"];
    }

    echo json_encode($salida);
}