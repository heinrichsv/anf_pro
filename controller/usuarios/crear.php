<?php

include("../../model/conexion.php");
include("funciones.php");

if ($_POST["operacion"] == "Crear") {
    $imagen = '';
    if ($_FILES["imagen_usuario"]["name"] != '') {
        $imagen = subir_imagen();
    }
    $stmt = $conexion->prepare("INSERT INTO usuarios(nombres, apellidos, email, password, id_rol, imagen, id_empleado)VALUES(:nombres, :apellidos, :email, :password, :id_rol, :imagen, :id_empleado)");

    $resultado = $stmt->execute(
        array(
            ':nombres'    => $_POST["nombres"],
            ':apellidos'    => $_POST["apellidos"],
            ':email'    => $_POST["email"],
            ':password'    => $_POST["password"],
            ':id_rol'    => $_POST["id_rol"],
            ':imagen'    => $imagen,            
            ':id_empleado'    => $_POST["id_empleado"]

        )
    );

    if (!empty($resultado)) {
        echo 'Registro creado';
    }
}


if ($_POST["operacion"] == "Editar") {
    $imagen = '';
    if ($_FILES["imagen_usuario"]["name"] != '') {
        $imagen = subir_imagen();
    }else{
        $imagen = $_POST["imagen_usuario_oculta"];
    }

    $stmt = $conexion->prepare("UPDATE usuarios SET nombres=:nombres, apellidos=:apellidos, imagen=:imagen, email=:email, password=:password,
                                id_rol=:id_rol, id_empleado=:id_empleado WHERE id_usuario = :id_usuario");


    $resultado = $stmt->execute(
        array(
            ':nombres'    => $_POST["nombres"],
            ':apellidos'    => $_POST["apellidos"],
            ':email'    => $_POST["email"],
            ':password'    => $_POST["password"],
            ':imagen'    => $imagen,
            ':id_rol'    => $_POST["id_rol"],      
            ':id_empleado'    => $_POST["id_empleado"],
            ':id_usuario'    => $_POST["id_usuario"]   
        )
    );

    if (!empty($resultado)) {
        echo 'Registro actualizado';
    }
}