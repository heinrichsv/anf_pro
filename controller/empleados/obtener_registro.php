<?php

include("../../model/conexion.php");
include("funciones.php");

if (isset($_POST["id_empleado"])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT id_empleado, nombres, apellidos, cargo, date_format(fecha_ingreso, '%d/%m/%Y') fecha_ingreso, date_format(fecha_salida, '%d/%m/%Y') fecha_salida, salario, estado, id_depto FROM empleados WHERE id_empleado = '".$_POST["id_empleado"]."' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach($resultado as $fila){
        $salida["nombres"] = $fila["nombres"];
        $salida["apellidos"] = $fila["apellidos"];
        $salida["cargo"] = $fila["cargo"];
        $salida["fecha_ingreso"] = $fila["fecha_ingreso"];
        $salida["fecha_salida"] = $fila["fecha_salida"];
        $salida["salario"] = $fila["salario"];
        $salida["estado"] = $fila["estado"];
        $salida["id_depto"] = $fila["id_depto"];
    }

    echo json_encode($salida);
}