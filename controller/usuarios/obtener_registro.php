<?php

include("../../model/conexion.php");
include("funciones.php");

if (isset($_POST["id_usuario"])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT id_usuario, nombres, apellidos, imagen, id_rol, email, password, fecha_creacion, id_empleado FROM usuarios WHERE id_usuario = '".$_POST["id_usuario"]."' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach($resultado as $fila){
        $salida["nombres"] = $fila["nombres"];
        $salida["apellidos"] = $fila["apellidos"];
        $salida["email"] = $fila["email"];
        $salida["password"] = $fila["password"];
        $salida["id_rol"] = $fila["id_rol"];
        if ($fila["imagen"] != "") {
            $salida["imagen_usuario"] = '<img src="../../controller/usuarios/img/' . $fila["imagen"] . '"  class="img-thumbnail" width="100" height="50" /><input type="hidden" name="imagen_usuario_oculta" value="'.$fila["imagen"].'" />';
        }else{
            $salida["imagen_usuario"] = '<input type="hidden" name="imagen_usuario_oculta" value="" />';
        }
        $salida["id_empleado"] = $fila["id_empleado"];
    }

    echo json_encode($salida);
}