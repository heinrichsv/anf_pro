<?php

include("../../model/conexion.php");
include("funciones.php");

if (isset($_POST["id_depto"])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT id_depto, nombre, estado FROM departamentos WHERE id_depto = '".$_POST["id_depto"]."' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach($resultado as $fila){
        $salida["nombre"] = $fila["nombre"];
        $salida["estado"] = $fila["estado"];
        $salida["id_depto"] = $fila["id_depto"];
    }

    echo json_encode($salida);
}