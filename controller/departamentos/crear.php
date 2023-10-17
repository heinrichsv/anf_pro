<?php

include("../../model/conexion.php");
include("funciones.php");

if ($_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO departamentos(nombre, estado) VALUES (:nombre, :estado)");

    $resultado = $stmt->execute(
        array(
            ':nombre'    => $_POST["nombre"],
            ':estado'    => $_POST["estado"]
        )
    );

    if (!empty($resultado)) {
        echo 'Registro creado';
    }
}


if ($_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE departamentos SET nombre=:nombre, estado=:estado WHERE id_depto = :id_depto");

    $resultado = $stmt->execute(
        array(
            ':nombre'    => $_POST["nombre"],
            ':estado'    => $_POST["estado"],
            ':id_depto'    => $_POST["id_depto"]
        )
    );

    if (!empty($resultado)) {
        echo 'Registro actualizado';
    }
}