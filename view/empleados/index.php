<?php
if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION["Titulo"] = "Empleados";
}

require_once("../master/head_mtto.php")
?>
<div class="row">
    <div class="col-2 offset-10">
        <div class="text-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
                <i class="bi bi-plus-circle-fill"></i> Crear
            </button>
        </div>
    </div>
</div>
<br />
<br />

<div class="table-responsive">
    <table id="datos_usuario" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cargo</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
                <th>Salario</th>
                <th>Estado</th>
                <th>Departamento</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
    </table>
</div>



<!-- Modal -->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ficha de Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" id="formulario" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos Generales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Ingresos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Descuentos</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <br />
                                <!-- Tab - Datos Generales -->
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos">
                                    </div>
                                </div>

                                <br />

                                <div class="row">
                                    <div class="col">
                                        <label for="fecha_nacimiento">Fecha de nacimiento:&nbsp;</label>
                                        <div class="input-group date" id="fecha_nacimiento">
                                            <input type="text" class="form-control" name="fecha_nacimiento" value="01/01/1985" required />
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-light d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="sexo">Sexo:&nbsp;</label>
                                        <select class="form-select" id="sexo" name="sexo">
                                            <option selected>Seleccione...</option>
                                            <option value="1">Masculino</option>
                                            <option value="2">Femenino</option>
                                        </select>

                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col">
                                      
                                    </div>
                                    <div class="col">
                                      
                                    </div>
                                </div> -->
                                <br />
                                <div class="row">
                                    <div class="col">
                                        <label for="dui" class="form-label">DUI</label>
                                        <input type="text" class="form-control" id="dui" name="dui">
                                    </div>
                                    <div class="col">
                                        <label for="nit" class="form-label">NIT</label>
                                        <input type="text" class="form-control" id="nit" name="nit">
                                    </div>
                                    <div class="col">
                                        <label for="nup" class="form-label">NUP</label>
                                        <input type="text" class="form-control" id="nup" name="nup">
                                    </div>
                                    <div class="col">
                                        <label for="isss" class="form-label">ISSS</label>
                                        <input type="text" class="form-control" id="isss" name="isss">
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col">
                                        <label for="estado-civil" class="form-label">Estado Civil</label>
                                        <select class="form-select" id="estado_civil" name="estado_civil">
                                            <option selected>Selecciona una opción</option>
                                            <option value="soltero">Soltero</option>
                                            <option value="casado">Casado</option>
                                            <option value="divorciado">Divorciado</option>
                                            <option value="viudo">Viudo</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label for="telefono" class="form-label">Telefono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono">
                                    </div>
                                    <div class="col">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion">
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col">
                                        <label for="cargo">Ingrese el cargo</label>
                                        <input type="text" name="cargo" id="cargo" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="id_depto">Seleccione el departamento:&nbsp;</label>
                                        <select class="form-select" name="id_depto" id="id_depto" required>
                                            <option value="0">Elija un departamento...</option>
                                            <?php
                                            include_once("../../model/conexion.php");
                                            $query = "SELECT id_depto, nombre FROM departamentos ";
                                            $stmt = $conexion->prepare($query);
                                            $stmt->execute();
                                            $resultado = $stmt->fetchAll();
                                            $datos = array();
                                            $filtered_rows = $stmt->rowCount();
                                            foreach ($resultado as $fila) {
                                                $id_depto = $fila["id_depto"];
                                                $nombre = $fila["nombre"];

                                                echo "<option value='" . $id_depto . "' >" . $nombre . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col">
                                        <label for="fecha_ingreso">Seleccione la fecha de ingreso:&nbsp;</label>
                                        <div class="input-group date" id="fecha_ingreso">
                                            <input type="text" class="form-control" name="fecha_ingreso" required />
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-light d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="col">
                                        <label for="fecha_salida">Seleccione la fecha de salida:&nbsp;</label>
                                        <div class="input-group date" id="fecha_salida">
                                            <input type="text" class="form-control" name="fecha_salida" />
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-light d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col">
                                        <label for="salario">Ingrese el salario mensual($):</label>
                                        <input type="number" step="any" min="0.01" max="999999999999999.99" maxlength="18" name="salario" id="salario" class="form-control" required>
                                    </div>
                                    <div class="col">
                                        <label for="estado">Estado:&nbsp;</label>
                                        <br />
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="estado" id="estadoA" value="A" checked>
                                            <label class="form-check-label" for="estado1">Activo</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="estado" id="estadoI" value="I" >
                                            <label class="form-check-label" for="estado2">Inactivo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">

                                    </div>
                                    <div class="col">

                                    </div>
                                </div>


                            </div>

                            <!-- Tab Ingresos -->
                            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                <br/>
                                <form class="" method="POST" id="ingresos_form" name="ingresos_form" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="col">
                                            <label for="descuento" class="col">Tipo de Ingreso</label>
                                            <br/>
                                            <select class="form-control" id="tipo_ingreso" name="tipo_ingreso">
                                                <option selected>Selecciona una opción</option>
                                                <option value="1">Horas Extra Diurna</option>
                                                <option value="2">Horas Extra Nocturna</option>
                                                <option value="3">Anticipo</option>
                                                <option value="4">Bonoficacion</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col">
                                            <label for="cantidad" class="col">Cantidad</label>
                                            <br/>
                                            <input type="number" class="form-control" id="cantidad" name="cantidad">
                                        </div>
                                        
                                        <div class="col">
                                            <label for="monto" class="col">Monto</label>
                                            <br/>
                                            <input type="number" class="form-control" id="monto" name="monto">
                                        </div>
                                        
                                        <div class="col">
                                            <br/>
                                            <!-- <input type="hidden" name="operacion2" id="operacion2" value="Ingresar">-->
                                            <button type="button" id="registrar_ingresos" name="registrar_ingresos" class="btn btn-primary registrar_ingresos">Ingresar</button>
                                        </div>
                                    </div>
                                    
                                </form>
                                <br/>           
                                <table class="table" id="tabla_ingresos">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tipo de Ingreso</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Aquí se agregarán los registros del formulario -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_empleado" id="id_empleado">
                        <input type="hidden" name="operacion" id="operacion">
                        <input type="submit" name="action" id="action" class="btn btn-success" value="Guardar Datos">
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Bootstrap Date-Picker Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js" integrity="sha512-5pjEAV8mgR98bRTcqwZ3An0MYSOleV04mwwYj2yw+7PBhFVf/0KcE+NEox0XrFiU5+x5t5qidmo5MgBkDD9hEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script type="text/javascript">
    $(document).ready(function() {

        var today = new Date();
        $('#fecha_ingreso').datepicker({
            language: 'es',
            defaultDate: new Date(today.getFullYear(), String(today.getMonth() + 1).padStart(2, '0'), String(today.getDate()).padStart(2, '0'))
        });

        $('#fecha_salida').datepicker({
            language: 'es',
            defaultDate: new Date(today.getFullYear(), String(today.getMonth() + 1).padStart(2, '0'), String(today.getDate()).padStart(2, '0'))
        });

        $('#fecha_nacimiento').datepicker({
            language: 'es',
            formatDate: 'dd/mm/yy'
        });

        $("#botonCrear").click(function() {
            $("#formulario")[0].reset();
            $(".modal-title").text("Ficha de Empleado");
            $("#action").val("Crear");
            $("#operacion").val("Crear");
        });



        var dataTable = $('#datos_usuario').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "../../controller/empleados/obtener_registros.php",
                type: "POST"
            },
            "columnsDefs": [{
                "targets": [0, 3, 4],
                "orderable": false,
            }, ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

        //Aquí código inserción
        $(document).on('submit', '#formulario', function(event) {
            event.preventDefault();
            var nombre = $('#nombres').val();
            var apellidos = $('#apellidos').val();
            var cargo = $('#cargo').val();
            var fecha_ingreso = $('#fecha_ingreso').val();
            var fecha_salida = $('#fecha_salida').val();
            var salario = $('#salario').val();
            var estado = $('#estado').val();
            var id_depto = $('#id_depto').val();
            var fecha_nacimiento = $('#fecha_nacimiento').val();
            var sexo = $('#sexo').val();
            var dui = $('#dui').val();
            var nit = $('#nit').val();
            var nup = $('#nup').val();
            var isss = $('#isss').val();
            var estado_civil = $('#estado_civil').val();
            var telefono = $('#telefono').val();
            var direccion = $('#direccion').val();

            if (nombre != '' && apellidos != '' && cargo != '') {
                $.ajax({
                    url: "../../controller/empleados/crear.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        alert(data);
                        $('#formulario')[0].reset();
                        dataTable.ajax.reload();
                        $('#modalUsuario').modal('hide');
                    }
                });
            } else {
                alert("Algunos campos son obligatorios");
            }
        });

        //Funcionalidad de editar
        $(document).on('click', '.editar', function() {
            var id_empleado = $(this).attr("id");
            $.ajax({
                url: "../../controller/empleados/obtener_registro.php",
                method: "POST",
                data: {
                    id_empleado: id_empleado
                },
                dataType: "json",
                success: function(data) {
                    //console.log(data);	
                    $('#modalUsuario').modal('show');
                    $('#nombres').val(data.nombres);
                    $('#apellidos').val(data.apellidos);
                    $('#cargo').val(data.cargo);
                    $('#fecha_ingreso').datepicker('setDate', data.fecha_ingreso); //.val(data.fecha);
                    $('#fecha_salida').datepicker('setDate', data.fecha_salida); //.val(data.fecha);
                    $('#salario').val(data.salario);

                    if (data.estado === 'A') {
                        $('#estadoA').prop('checked', true);
                    } else {
                        $('#estadoI').prop('checked', true);
                    }

                    $('#id_depto option[value="' + data.id_depto + '"]').attr("selected", "selected");
                    $('#fecha_nacimiento').datepicker('setDate', data.fecha_nacimiento);
                    $('#sexo').val(data.sexo);
                    $('#dui').val(data.dui);
                    $('#nit').val(data.nit);
                    $('#nup').val(data.nup);
                    $('#isss').val(data.isss);
                    $('#estado_civil').val(data.estado_civil);
                    $('#telefono').val(data.telefono);
                    $('#direccion').val(data.direccion);
                    $('#registrar_ingresos').val(id_empleado);

                    $('.modal-title').text("Editar Ficha Empleado");
                    $('#id_empleado').val(id_empleado);
                    $('#action').val("Editar");
                    $('#operacion').val("Editar");
                    $('#modalUsuario').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
        });

        //Funcionalidad de borrar
        $(document).on('click', '.borrar', function() {
            var id_empleado = $(this).attr("id");
            if (confirm("Esta seguro de borrar este registro:" + id_empleado)) {
                $.ajax({
                    url: "../../controller/empleados/borrar.php",
                    method: "POST",
                    data: {
                        id_empleado: id_empleado
                    },
                    success: function(data) {
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            } else {
                return false;
            }
        });

        // funcionalidad ingresos
        $(document).on('click', '.registrar_ingresos', function(event) {
            event.preventDefault();
            var id_empleado = $(this).val();

            var tipo_ingreso =  $('#tipo_ingreso').val();
            var cantidad = $('#cantidad').val();
            var monto = $('#monto').val();      
            
            if (monto != '' && cantidad != '') {
                $.ajax({
                    url: "../../controller/empleados/crear.php",
                    method: 'POST',
                    data: {
                        id_empleado: id_empleado,
                        cantidad: cantidad,
                        monto: monto,
                        operacion2: 'Ingresar'
                    },
                    dataType : 'json',
                    processData: false,
                    success: function(data) {
                        
                        // Agrega una nueva fila a la tabla con los valores del formulario
                        $('table#tabla_ingresos tbody').append('<tr><td>' + data.tipo_ingreso + '</td><td>' + data.cantidad + '</td><td>' + data.monto + '</td></tr>');

                        // Limpia los campos del formulario
                        $('#tipo_ingreso').val('');
                        $('#cantidad').val('');
                        $('#monto').val('');
                    }
                });
            } else {
                alert("Algunos campos son obligatorios");
            }
        });

    });
</script>

<?php
require_once("../master/footer.php")
?>