<?php

if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../../model/conexion.php");
include("funciones.php");

if ($_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO empleados(nombres, apellidos, cargo, fecha_ingreso, fecha_salida, salario, estado, id_depto) VALUES (:nombres, :apellidos, :cargo, STR_TO_DATE(:fecha_ingreso,'%d/%m/%Y'), STR_TO_DATE(:fecha_salida,'%d/%m/%Y'), :salario, :estado, :id_depto)");

    $resultado = $stmt->execute(
        array(
            ':nombres'    => $_POST["nombres"],
            ':apellidos'    => $_POST["apellidos"],
            ':cargo'    => $_POST["cargo"],
            ':fecha_ingreso'    => $_POST["fecha_ingreso"],
            ':fecha_salida'    => $_POST["fecha_salida"],
            ':salario'    => $_POST["salario"],
            ':estado'    => $_POST["estado"],
            ':id_depto'    => $_POST["id_depto"]
        )
    );

    if (!empty($resultado)) {
        echo 'Registro creado';
    }
}


if ($_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE empleados SET nombres=:nombres, apellidos=:apellidos, cargo=:cargo, fecha_ingreso=STR_TO_DATE(:fecha_ingreso,'%d/%m/%Y'), fecha_salida=STR_TO_DATE(:fecha_salida,'%d/%m/%Y'), salario=:salario, estado=:estado, id_depto=:id_depto WHERE id_empleado = :id_empleado");

    $resultado = $stmt->execute(
        array(
            ':id_empleado'    => $_POST["id_empleado"],
            ':nombres'    => $_POST["nombres"],
            ':apellidos'    => $_POST["apellidos"],
            ':cargo'    => $_POST["cargo"],
            ':fecha_ingreso'    => $_POST["fecha_ingreso"],
            ':fecha_salida'    => $_POST["fecha_salida"],
            ':salario'    => $_POST["salario"],
            ':estado'    => $_POST["estado"],
            ':id_depto'    => $_POST["id_depto"]
        )
    );

    if (!empty($resultado)) {
        echo 'Registro actualizado';
    }
}
