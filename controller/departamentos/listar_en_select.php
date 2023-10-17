<?php

    include("../../model/conexion.php");
    include("funciones.php");

    $query = "";
    $salida = array();
    $query = "SELECT id_depto, nombre, estado FROM departamentos where estado = 'A' ORDER BY nombre asc";

    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();

    if ($filtered_rows === 0) {
        echo "No hay departamentos parametrizados.";
        exit();
    }

    
    
    foreach($resultado as $fila){
        $sub_array = array();
        $sub_array[] = $fila["id_depto"];
        $sub_array[] = $fila["nombre"];
        $sub_array[] = $fila["estado"];
        $sub_array[] = '<button type="button" name="editar" id="'.$fila["id_depto"].'" class="btn btn-warning btn-xs editar">Editar</button>';
        $sub_array[] = '<button type="button" name="borrar" id="'.$fila["id_depto"].'" class="btn btn-danger btn-xs borrar">Borrar</button>';
        $datos[] = $sub_array;
    }

    $salida = array(
        "draw"               => intval($_POST["draw"]),
        "recordsTotal"       => $filtered_rows,
        "recordsFiltered"    => obtener_todos_registros(),
        "data"               => $datos
    );

    echo json_encode($salida);