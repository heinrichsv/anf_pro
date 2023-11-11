<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">
        <div class="container-fluid" style="background-color:#f8f9fa;">

            <a class="nav-link" style="color:black;" href="../home/index.php">
                <img src="../assets/_logo.jpeg" class="img-fluid" alt="Responsive image" style="height: 50px;">
                PC Service & Solutions, S.A. de C.V</a>
        </div>
    </div>
    <div class="list-group list-group-flush">
        <?php
        /*if (isset($_SESSION) && isset($_SESSION['id_empleado'])) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../resumen/index.php">Resumen</a>';
        }*/
        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '3' || $_SESSION['id_rol'] == '4')) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../empleados/index.php"><i class="fa-solid fa-user-tie"></i>&nbsp;Empleados</a>';
        }
        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '3' || $_SESSION['id_rol'] == '4')) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../departamentos/index.php"><i class="fa-solid fa-people-group"></i>&nbsp;Departamentos</a>';
        }
        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '2' || $_SESSION['id_rol'] == '3')) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../planilla/index.php"><i class="fa-solid fa-table"></i>&nbsp;Planillas</a>';
        }
        
        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '2')) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../costeo/index.php"><i class="fa-solid fa-dollar-sign"></i>&nbsp;Costeo de planilla</a>';
        }

        if (isset($_SESSION) && ($_SESSION['id_rol'] == '1' || $_SESSION['id_rol'] == '4')) {
            echo '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="../usuarios/index.php"><i class="fa-solid fa-user"></i>&nbsp;Usuarios</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="../roles/index.php"><i class="fa-solid fa-lock-open"></i>&nbsp;Roles</a>';
        }
        ?>
    </div>
</div>