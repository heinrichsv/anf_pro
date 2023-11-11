<?php

if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../../model/conexion.php");
include("funciones.php");

if (!empty($_POST["operacion"]) && $_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO empleados(nombres, apellidos, cargo, fecha_ingreso, fecha_salida, salario, estado, id_depto, fecha_nacimiento, sexo, dui, nit, nup, isss, estado_civil, telefono, direccion ) VALUES (:nombres, :apellidos, :cargo, STR_TO_DATE(:fecha_ingreso,'%d/%m/%Y'), STR_TO_DATE(:fecha_salida,'%d/%m/%Y'), :salario, :estado, :id_depto, STR_TO_DATE(:fecha_nacimiento,'%d/%m/%Y'), :sexo, :dui, :nit, :nup, :isss, :estado_civil, :telefono, :direccion)");

    $resultado = $stmt->execute(
        array(
            ':nombres'    => $_POST["nombres"],
            ':apellidos'    => $_POST["apellidos"],
            ':cargo'    => $_POST["cargo"],
            ':fecha_ingreso'    => $_POST["fecha_ingreso"],
            ':fecha_salida'    => NULL,
            ':salario'    => $_POST["salario"],
            ':estado'    => $_POST["estado"],
            ':id_depto'    => $_POST["id_depto"],
            ':fecha_nacimiento'    => $_POST["fecha_nacimiento"],
            ':sexo'    => $_POST["sexo"],
            ':dui'    => $_POST["dui"],
            ':nit'    => $_POST["nit"],
            ':nup'    => $_POST["nup"],
            ':isss'    => $_POST["isss"],
            ':estado_civil'    => $_POST["estado_civil"],
            ':telefono'    => $_POST["telefono"],
            ':direccion'    => $_POST["direccion"]
        )
    );

    if (!empty($resultado)) {
        echo '
        Registro creado correctamente';
    }
}


if (!empty($_POST["operacion"]) && $_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE empleados SET nombres=:nombres, apellidos=:apellidos, cargo=:cargo, fecha_ingreso=STR_TO_DATE(:fecha_ingreso,'%d/%m/%Y'), fecha_salida=STR_TO_DATE(:fecha_salida,'%d/%m/%Y'), salario=:salario, estado=:estado, id_depto=:id_depto, fecha_nacimiento=STR_TO_DATE(:fecha_nacimiento,'%d/%m/%Y'), sexo=:sexo, dui=:dui, nit=:nit, nup=:nup, isss=:isss, estado_civil=:estado_civil, telefono=:telefono, direccion=:direccion WHERE id_empleado = :id_empleado");

    $resultado = $stmt->execute(
        array(
            ':id_empleado'    => $_POST["id_empleado"],
            ':nombres'    => $_POST["nombres"],
            ':apellidos'    => $_POST["apellidos"],
            ':cargo'    => $_POST["cargo"],
            ':fecha_ingreso'    => $_POST["fecha_ingreso"],
            ':fecha_salida'    => (empty($_POST["fecha_salida"])? NULL : $_POST["fecha_salida"]),
            ':salario'    => $_POST["salario"],
            ':estado'    => $_POST["estado"],
            ':id_depto'    => $_POST["id_depto"],
            ':fecha_nacimiento'    => $_POST["fecha_nacimiento"],
            ':sexo'    => $_POST["sexo"],
            ':dui'    => $_POST["dui"],
            ':nit'    => $_POST["nit"],
            ':nup'    => $_POST["nup"],
            ':isss'    => $_POST["isss"],
            ':estado_civil'    => $_POST["estado_civil"],
            ':telefono'    => $_POST["telefono"],
            ':direccion'    => $_POST["direccion"]
        )
    );

    if (!empty($resultado)) {
        echo '
        Registro actualizado correctamente';
    }    
}

if (!empty($_POST["operacion2"]) && $_POST["operacion2"] == "Ingresar") {
    $tipos_ingreso_array = array(
        '1' => "Horas Extra Diurna",
        '2' => "Horas Extra Nocturna",
        '3' => "Anticipo",
        '4' => "Bonificacion",
    );
    
    $stmt = $conexion->prepare("INSERT INTO ingresos(fecha_registrado, fecha_aplicado, id_empleado, cantidad, monto, estado_aplicacion, tipo_ingreso, nombre_ingreso ) VALUES (:fecha_registrado, :fecha_aplicado, :id_empleado, :cantidad, :monto, :estado_aplicacion, :tipo_ingreso, :nombre_ingreso )");

    $resultado = $stmt->execute(
        array(
            ':fecha_registrado'    => date("Y-m-d"),
            ':fecha_aplicado'    => NULL,
            ':id_empleado'    => $_POST["id_empleado"],
            ':cantidad'    => $_POST["cantidad"],
            ':monto'    => $_POST["monto"],
            ':estado_aplicacion'    => 'A',                
            ':tipo_ingreso'    => $_POST["tipo_ingreso"],                
            ':nombre_ingreso'    => $tipos_ingreso_array[$_POST["tipo_ingreso"]],                
        )
    );

    if (!empty($resultado)) {
        $stmt2 = $conexion->prepare("SELECT tipo_ingreso, nombre_ingreso, cantidad, monto FROM ingresos WHERE id_empleado = '".$_POST["id_empleado"]."' ORDER BY id_ingreso DESC LIMIT 1");
        $stmt2->execute();
        $resultado = $stmt2->fetchAll();
        foreach($resultado as $fila){
            $salida["tipo_ingreso"] = $tipos_ingreso_array[$_POST["tipo_ingreso"]];
            $salida["cantidad"] = $fila["cantidad"];
            $salida["monto"] = $fila["monto"];                      
        }

        echo json_encode($salida);
    }
}
