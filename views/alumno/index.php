<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php require 'views/header.php' ?>
    <div id="main">
        <h2>Listado de Alumnos</h2><br>
        <span class="btn btn-raised btn-success btn-lg" data-toggle="modal" data-target="#modalAdd">
            Nuevo Alumno
        </span><br><br>

        <div>
            <table id="Table" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>TELEFONO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once 'models/alumnos.php';
                    foreach ($this->alumnos as $item) {
                        $alumno = new Alumnos();
                        $alumno = $item;
                        ?>
                        <tr>
                            <td><?php echo $alumno->id; ?></td>
                            <td><?php echo $alumno->nombre; ?></td>
                            <td><?php echo $alumno->apellido; ?></td>
                            <td><?php echo $alumno->telefono; ?></td>
                            <td>
                                <span class="btn btn-raised btn-warning btn-xs" onclick="obtenDatos('<?php echo $alumno->id; ?>')" data-toggle="modal" data-target="#modalEdit">
                                    <span class="fa fa-pencil-square-o"></span> Editar
                                </span>
                                <span class="btn btn-raised btn-danger btn-xs" onclick="eliminar('<?php echo $alumno->id; ?>')">
                                    <span class="fa fa-trash"></span> Eliminar
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


        <!-----------------------Modal para agregar------------------------->
        <div class="modal fade" id="modalAdd">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Alumno</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="frmAgregar">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" required><br>
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control form-control-sm" name="apellido" id="apellido" required><br>
                            <label for="telefono">Telefono</label>
                            <input type="text" class="form-control form-control-sm" name="telefono" id="telefono" required><br>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-raised btn-success" id="btnAddAlumno">Registrar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-----------------------Modal para editarar------------------------->
        <div class="modal fade" id="modalEdit">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Alumno</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="frmActualizar">
                            <label for="nombreU">Nombre</label>
                            <input type="text" class="form-control form-control-sm" name="nombreU" id="nombreU" required><br>
                            <label for="apellidoU">Apellido</label>
                            <input type="text" class="form-control form-control-sm" name="apellidoU" id="apellidoU" required><br>
                            <label for="telefonoU">Telefono</label>
                            <input type="text" class="form-control form-control-sm" name="telefonoU" id="telefonoU" required><br>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-raised btn-primary" id="btnEditAlumno">Modificar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php require 'views/footer.php' ?>
</body>

</html>