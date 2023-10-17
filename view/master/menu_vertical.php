<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">PC Service & Solutions, S.A. de C.V</div>
    <div class="list-group list-group-flush">
    <?php
        /*if (isset($_SESSION) && isset($_SESSION['id_empleado'])) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../resumen/index.php">Resumen</a>';
        }*/
        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '2' || $_SESSION['id_rol'] == '3')) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../planilla/index.php"><i class="fa-solid fa-table"></i>&nbsp;Planillas</a>';
        }
        /*
        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '2')) {
		    echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../costeo/index.php">Costeo de planilla</a>';
        }*/
        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '3' || $_SESSION['id_rol'] == '4')) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../departamentos/index.php"><i class="fa-solid fa-people-group"></i>&nbsp;Departamentos</a>';
        }
        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '3' || $_SESSION['id_rol'] == '4')) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../empleados/index.php"><i class="fa-solid fa-user-tie"></i>&nbsp;Empleados</a>';
        }
        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '4')) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../usuarios/index.php"><i class="fa-solid fa-user"></i>&nbsp;Usuarios</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="../roles/index.php"><i class="fa-solid fa-lock-open"></i>&nbsp;Roles</a>'
            ;
        }
        ?>
    </div>
</div>