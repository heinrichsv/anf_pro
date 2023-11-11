<?php

    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
        $_SESSION["Titulo"] = "Bienvenido!";
    }

    require_once("../master/head_mtto.php")
?>

        <h3 style="">Sistema de Gestión de Planilla de PC Service & Solutions, S.A. de C.V</h3>
        <img src="../assets/nomina.jpg" style="height: 450px;" />
        <p>
            Version: 1.0
        </p>
    
    
<?php
    require_once("../master/footer.php")
?>