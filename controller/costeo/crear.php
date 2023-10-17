<?php

include("../../model/conexion.php");
include("funciones.php");

if ($_POST["operacion"] == "Crear") {
   
    $stmt = $conexion->prepare("INSERT INTO categorias(nombre, estado, presupuesto)VALUES(:nombre, :estado, :presupuesto)");

    $resultado = $stmt->execute(
        array(
            ':nombre'    => $_POST["nombre"],
            ':estado'    => $_POST["estado"],
            ':presupuesto'    => $_POST["presupuesto"]
        )
    );

    if (!empty($resultado)) {
        echo 'Registro creado';
    }
}


if ($_POST["operacion"] == "Editar") {
   
    $stmt = $conexion->prepare("UPDATE categorias SET nombre=:nombre, estado=:estado, presupuesto=:presupuesto  WHERE id_categoria = :id");

    $resultado = $stmt->execute(
        array(
            ':nombre'    => $_POST["nombre"],
            ':estado'    => $_POST["estado"],
            ':presupuesto'    => $_POST["presupuesto"],
            ':id'        => $_POST["id_categoria"]
        )
    );

    if (!empty($resultado)) {
        echo 'Registro actualizado';
    }
}