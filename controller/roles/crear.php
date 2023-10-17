<?php

include("../../model/conexion.php");
include("funciones.php");

if ($_POST["operacion"] == "Crear") {
    $stmt = $conexion->prepare("INSERT INTO roles(nombre, estado) VALUES (:nombre, :estado)");

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
    $stmt = $conexion->prepare("UPDATE roles SET nombre=:nombre, estado=:estado WHERE id_rol = :id_rol");

    $resultado = $stmt->execute(
        array(
            ':nombre'    => $_POST["nombre"],
            ':estado'    => $_POST["estado"],
            ':id_rol'    => $_POST["id_rol"]
        )
    );

    if (!empty($resultado)) {
        echo 'Registro actualizado';
    }
}