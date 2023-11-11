<?php

include("../../model/conexion.php");
include("funciones.php");

if (isset($_POST["id_empleado"])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT id_empleado, nombres, apellidos, cargo, date_format(fecha_ingreso, '%d/%m/%Y') fecha_ingreso, date_format(fecha_salida, '%d/%m/%Y') fecha_salida, salario, estado, id_depto, date_format(fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento, sexo, dui, nit, nup, isss, estado_civil, telefono, direccion FROM empleados WHERE id_empleado = '".$_POST["id_empleado"]."' LIMIT 1");
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
        $salida["fecha_nacimiento"] = $fila["fecha_nacimiento"];
        $salida["sexo"] = $fila["sexo"];
        $salida["dui"] = $fila["dui"];
        $salida["nit"] = $fila["nit"];
        $salida["nup"] = $fila["nup"];
        $salida["isss"] = $fila["isss"];
        $salida["estado_civil"] = $fila["estado_civil"];
        $salida["telefono"] = $fila["telefono"];
        $salida["direccion"] = $fila["direccion"];
        
    }

    echo json_encode($salida);
}