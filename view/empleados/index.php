<?php
    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
        $_SESSION["Titulo"] = "Empleados";
    }

    require_once("../master/head_mtto.php")
?>
        <div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
                        <i class="bi bi-plus-circle-fill"></i> Crear
                        </button>
                </div>
            </div>
        </div>
        <br />
        <br />

        <div class="table-responsive">
            <table id="datos_usuario" class="table table-bordered table-striped">
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Empleados</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
        <form method="POST" id="formulario" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                <label for="nombres">Ingrese los nombres</label>
                    <input type="text" name="nombres" id="nombres" class="form-control">
                    <br />

                    <label for="apellidos">Ingrese los apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control">
                    <br />

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
                        foreach($resultado as $fila){
                            $id_depto = $fila["id_depto"];
                            $nombre = $fila["nombre"];

                            echo "<option value='".$id_depto."' >".$nombre."</option>";
                        }
                        ?>
                    </select>
                    <br />

                    <label for="cargo">Ingrese el cargo</label>
                    <input type="text" name="cargo" id="cargo" class="form-control">
                    <br />

                    <label for="fecha_ingreso">Seleccione la fecha de ingreso:&nbsp;</label>
                    <div class="input-group date" id="fecha_ingreso">
                        <input type="text" class="form-control" name="fecha_ingreso" required/>
                        <span class="input-group-append">
                        <span class="input-group-text bg-light d-block">
                            <i class="fa fa-calendar"></i>
                        </span>
                        </span>
                    </div>
                    <br />

                    <label for="fecha_salida">Seleccione la fecha de salida:&nbsp;</label>
                    <div class="input-group date" id="fecha_salida">
                        <input type="text" class="form-control" name="fecha_salida"/>
                        <span class="input-group-append">
                        <span class="input-group-text bg-light d-block">
                            <i class="fa fa-calendar"></i>
                        </span>
                        </span>
                    </div>
                    <br />

                    <label for="salario">Ingrese el salario:</label>
                    <input type="number" step="any" min="0.01" max="999999999999999.99" maxlength="18" name="salario" id="salario" class="form-control" <?php echo (isset($_SESSION) && $_SESSION['id_rol'] != '3') ? 'disabled' : ''; ?> required>
                    <br />

                    <label for="estado">Seleccione el estado:&nbsp;</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="estado" id="estadoA" value="A" <?php echo (isset($_SESSION) && $_SESSION['id_rol'] != '3') ? 'disabled' : ''; ?>  checked>
                            <label class="form-check-label" for="estado1">Activo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="estado" id="estadoI" value="I" <?php echo (isset($_SESSION) && $_SESSION['id_rol'] != '3') ? 'disabled' : ''; ?> >
                            <label class="form-check-label" for="estado2">Inactivo</label>
                        </div>
                    <br />
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id_empleado" id="id_empleado">
                    <input type="hidden" name="operacion" id="operacion">             
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Crear">
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
        $(document).ready(function(){

            var today = new Date();
            $('#fecha_ingreso').datepicker({
                language: 'es',
                defaultDate: new Date(today.getFullYear(), String(today.getMonth() + 1).padStart(2, '0'), String(today.getDate()).padStart(2, '0'))
            });

            $('#fecha_salida').datepicker({
                language: 'es',
                defaultDate: new Date(today.getFullYear(), String(today.getMonth() + 1).padStart(2, '0'), String(today.getDate()).padStart(2, '0'))
            });

            $("#botonCrear").click(function(){
                $("#formulario")[0].reset();
                $(".modal-title").text("Crear Empleado");
                $("#action").val("Crear");
                $("#operacion").val("Crear");
            });



            var dataTable = $('#datos_usuario').DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "ajax":{
                    url: "../../controller/empleados/obtener_registros.php",
                    type: "POST"
                },
                "columnsDefs":[
                    {
                    "targets":[0, 3, 4],
                    "orderable":false,
                    },
                ],
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
            $(document).on('submit', '#formulario', function(event){
            event.preventDefault();
            var nombre = $('#nombres').val();
            var apellidos = $('#apellidos').val();
            var cargo = $('#cargo').val();
            var fecha_ingreso = $('#fecha_ingreso').val();
            var fecha_salida = $('#fecha_salida').val();
            var salario = $('#salario').val();
            var estado = $('#estado').val();
            var id_depto = $('#id_depto').val();
		    if(nombre != '' && apellidos != '' && cargo != '')
                {
                    $.ajax({
                        url:"../../controller/empleados/crear.php",
                        method:'POST',
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {
                            alert(data);
                            $('#formulario')[0].reset();
                            $('#modalUsuario').modal('hide');
                            dataTable.ajax.reload();
                        }
                    });
                }
                else
                {
                    alert("Algunos campos son obligatorios");
                }
	        });

            //Funcionalidad de editar
            $(document).on('click', '.editar', function(){		
            var id_empleado = $(this).attr("id");		
            $.ajax({
                url:"../../controller/empleados/obtener_registro.php",
                method:"POST",
                data:{id_empleado:id_empleado},
                dataType:"json",
                success:function(data)
                    {
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

                        $('#id_depto option[value="'+data.id_depto+'"]').attr("selected", "selected");
                        $('.modal-title').text("Editar Departamento");
                        $('#id_empleado').val(id_empleado);
                        $('#action').val("Editar");
                        $('#operacion').val("Editar");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    }
                })
	        });

            //Funcionalidad de borrar
            $(document).on('click', '.borrar', function(){
                var id_empleado = $(this).attr("id");
                if(confirm("Esta seguro de borrar este registro:" + id_empleado))
                {
                    $.ajax({
                        url:"../../controller/empleados/borrar.php",
                        method:"POST",
                        data:{id_empleado:id_empleado},
                        success:function(data)
                        {
                            alert(data);
                            dataTable.ajax.reload();
                        }
                    });
                }
                else
                {
                    return false;	
                }
            });

        });         
    </script>
    
<?php
    require_once("../master/footer.php")
?>