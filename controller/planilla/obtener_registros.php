<?php

    include("../../model/conexion.php");
    include("funciones.php");
 

    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $query = "";

    $salida = array();
    $query = "SELECT nombres, apellidos, cargo, fecha_ingreso, salario,
                STR_TO_DATE('2021,12,12', '%Y,%m,%d') fec_calc_ant,
                STR_TO_DATE('2022,12,12', '%Y,%m,%d') fec_calc_act,
                DATEDIFF(STR_TO_DATE('2022,12,12', '%Y,%m,%d'), fecha_ingreso) AS dias_desde_ing,
                DATEDIFF(STR_TO_DATE('2022,12,12', '%Y,%m,%d'), STR_TO_DATE('2021,12,12', '%Y,%m,%d')) AS dias_desde_calc_ant
                FROM empleados emp where estado = 'A' ";
    
    if (($_SESSION['id_rol'] == '4' || $_SESSION['id_rol'] == '5') && isset($_SESSION['id_empleado'])) {
        $query .= 'AND id_empleado = ' . $_SESSION['id_empleado'] . ' ';
    }
    
    if (isset($_POST["search"]["value"])) {
        $query .= 'AND CONCAT(apellidos,\' \', nombres) LIKE "%' . $_POST["search"]["value"] . '%" ';
        
    }

    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $_POST['order']['0']['column'] .' '.$_POST["order"][0]['dir'] . ' ';        
    }else{
        $query .= 'ORDER BY fecha_ingreso ASC ';
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
        $sub_array[] = $fila["apellidos"] . ', ' . $fila["nombres"];
        $sub_array[] = $fila["fecha_ingreso"];

        $dias_desde_ing = $fila["dias_desde_ing"];
        $dias_desde_calc_ant = $fila["dias_desde_calc_ant"];

        $date1 = $fila["fecha_ingreso"];
        $date2 = date("Y-m-d");

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $mesesEnEmpresa = (($year2 - $year1) * 12) + ($month2 - $month1);

        $textoTiempoLaborado = "";

        if (($year2 - $year1) == 1) {
            $textoTiempoLaborado = "1 año ";
        }

        if (($year2 - $year1) > 1) {
            $textoTiempoLaborado = ($year2 - $year1) . " años ";
        }

        if ($mesesEnEmpresa % 12 > 0) {
            $textoTiempoLaborado .= ($mesesEnEmpresa % 12) . " meses ";
        }

        $sub_array[] = $textoTiempoLaborado;

        $salarioBase = round($fila["salario"], 2);

        $sub_array[] = "$".number_format($salarioBase,2);
        
        $montoAFP = round($salarioBase * 0.0725, 2);

        $sub_array[] = "$".number_format($montoAFP,2);

        $montoISSS = round($salarioBase * 0.03, 2);

        if ($montoISSS > 30) {
            $montoISSS = 30;
        }
        
        $sub_array[] = "$".number_format($montoISSS,2);

        $costoMensual = $salarioBase + $montoAFP + $montoISSS;

        /*if (12 - $month2 + ($mesesEnEmpresa % 12) >= 12) {
            $anhiosParaCalculo = $year2 - $year1 + 1;
        } else {
            $anhiosParaCalculo = $year2 - $year1;
        }*/
        $mesesEnEmpresa = 12 - $month2 + $mesesEnEmpresa;

        if ($mesesEnEmpresa < 12) {
            $factor = 15 * ($mesesEnEmpresa / 12);
        } else if ($mesesEnEmpresa >= 12 && $mesesEnEmpresa <= 36) {
            $factor = 15;
        } else if ($mesesEnEmpresa >= 36 && $mesesEnEmpresa < 120) {
            $factor = 19;
        } else if ($mesesEnEmpresa > 120) {
            $factor = 21;
        }

        if ($dias_desde_ing < 365) {
            $aguinaldo = $salarioBase / 30 * 15 * $dias_desde_ing / 365;
        } else {
            $aguinaldo = $salarioBase / 30 * $factor;
        }

        $renta = 0;
        $salarioNeto = round($salarioBase - $montoAFP - $montoISSS, 2);

        if ($salarioNeto >= 0.01 && $salarioNeto <= 472) {
            $renta = 0;
        } else if ($salarioNeto >= 472.01 && $salarioNeto <= 895.24) {
            $renta = ($salarioNeto - 472) * 0.1 + 17.67;
        } else if ($salarioNeto >= 895.25 && $salarioNeto <= 2038.10) {
            $renta = ($salarioNeto - 895.24) * 0.2 + 60;
        } else if ($salarioNeto >= 2038.11) {
            $renta = ($salarioNeto - 2038.10) * 0.3 + 288.57;
        }
        
        $sub_array[] = "$".number_format(round($renta, 2),2);

        $sub_array[] = "$".number_format(round($aguinaldo, 2),2);

        $vacaciones = round($salarioBase/30*15, 2);
        $vacaciones = $vacaciones * 1.3;
        
        $sub_array[] = "$".number_format(round($vacaciones, 2),2);

        $salarioNeto = round($salarioNeto - $renta, 2);

        $sub_array[] = "$".number_format(round($salarioNeto, 2), 2);

        $datos[] = $sub_array;
    }
    $salida = array(
        "draw"               => intval($_POST["draw"]),
        "recordsTotal"       => $filtered_rows,
        "recordsFiltered"    => obtener_todos_registros(),
        "data"               => $datos
    );

    echo json_encode($salida);
    