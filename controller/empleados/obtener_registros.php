<?php

    include("../../model/conexion.php");
    include("funciones.php");

    $query = "";
    $salida = array();
    $query = "SELECT id_empleado, nombres, apellidos, cargo, date_format(fecha_ingreso, '%d/%m/%Y') fecha_ingreso, date_format(fecha_salida, '%d/%m/%Y') fecha_salida, salario, if(estado='A', 'Activo', 'Inactivo') estado, (select dep.nombre from departamentos dep where dep.id_depto = emp.id_depto) id_depto FROM empleados emp";

    if (isset($_POST["search"]["value"])) {
       $query .= ' WHERE nombres LIKE "%' . $_POST["search"]["value"] . '%" ';
       $query .= 'OR apellidos LIKE "%' . $_POST["search"]["value"] . '%" ';
    }

    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $_POST['order']['0']['column'] .' '.$_POST["order"][0]['dir'] . ' ';        
    }else{
        $query .= 'ORDER BY id_empleado ASC ';
    }

    if($_POST["length"] != -1){
        $query .= 'LIMIT ' . $_POST["start"] . ','. $_POST["length"];
    }

    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $fila){

        $sub_array = array();
        $sub_array[] = $fila["id_empleado"];
        $sub_array[] = $fila["nombres"];
        $sub_array[] = $fila["apellidos"];
        $sub_array[] = $fila["cargo"];
        $sub_array[] = $fila["fecha_ingreso"];
        $sub_array[] = $fila["fecha_salida"];
        $sub_array[] = $fila["salario"];
        $sub_array[] = $fila["estado"];
        $sub_array[] = $fila["id_depto"];
        $sub_array[] = '<button type="button" name="editar" id="'.$fila["id_empleado"].'" class="btn btn-primary btn-xs editar">Editar</button>';
        $sub_array[] = '<button type="button" name="borrar" id="'.$fila["id_empleado"].'" class="btn btn-danger btn-xs borrar">Borrar</button>';
        $datos[] = $sub_array;
    }

    $salida = array(
        "draw"               => intval($_POST["draw"]),
        "recordsTotal"       => $filtered_rows,
        "recordsFiltered"    => obtener_todos_registros(),
        "data"               => $datos
    );

    echo json_encode($salida);