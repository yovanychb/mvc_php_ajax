var uri = "http://localhost/mvc_php_ajax/";

/**
 * Funcionalidad para agregar un registro
 */
$(document).ready(function () {
    $('#btnAddAlumno').click(function () {
        datos = $('#frmAgregar').serialize();
        $.ajax({
            type: "POST",
            data: datos,
            url: uri + "alumno/insert",
            success: function (r) {
                if (r == 1) {
                    $('#frmAgregar')[0].reset();
                    $('#modalAdd').modal('hide');
                    alert("Registro guardado");
                    cargarDatos();
                } else {
                }
            }
        });
    });
})

/**
 * Funcion para obetner el registro seleccionado
 * @param {id} id 
 */
function obtenDatos(id) {
    $.ajax({
        type: "GET",
        url: uri + "alumno/getById/" + id,
        success: function (r) {
            datos = jQuery.parseJSON(r);
            $('#nombreU').val(datos['nombre']);
            $('#apellidoU').val(datos['apellido']);
            $('#telefonoU').val(datos['telefono']);
        }
    });
}

/**
 * Bloque de codigo para realizar la actualizacion de un registro
 */
$(document).ready(function () {
    $('#btnEditAlumno').click(function () {
        datos = $('#frmActualizar').serialize();
        $.ajax({
            type: "POST",
            data: datos,
            url: uri + "alumno/update",
            success: function (r) {
                if (r == 1) {
                    $('#modalEdit').modal('hide');
                    alert("Registro modificado");
                    cargarDatos();
                } else {
                }
            }
        });
    });
});


/**
 * Funcion para eliminar un registro
 * @param {id} id 
 */
function eliminar(id) {
    $.ajax({
        type: "POST",
        url: uri + "alumno/delete/" + id,
        success: function (r) {
            if (r == 1) {
                alert("Registro eliminado");
                cargarDatos();
            } else {
            }
        }
    });
}


/**
 * Funcion para recrear la tabla
 */
function cargarDatos() {
    $.ajax({
        type: "GET",
        url: uri + "api/alumno",
        success: function (r) {
            datos = jQuery.parseJSON(r);
            tbody = '';
            for (i = 0; i < datos.length; i++) {
                tbody += '<tr>' +
                    '<td>' + datos[i]['id'] + '</td>' +
                    '<td>' + datos[i]['nombre'] + '</td>' +
                    '<td>' + datos[i]['apellido'] + '</td>' +
                    '<td>' + datos[i]['telefono'] + '</td>' +
                    '<td>' +
                    '<span class="btn btn-raised btn-warning btn-xs" onclick="obtenDatos(' + datos[i]['id'] + ')" data-toggle="modal" data-target="#modalEdit">' +
                    '<span class="fa fa-pencil-square-o" ></span > Editar' +
                    '</span > ' +
                    '<span class="btn btn-raised btn-danger btn-xs" onclick="eliminar(' + datos[i]['id'] + ')">' +
                    '<span class="fa fa-trash"></span> Eliminar' +
                    '</span>' +
                    '</td>' +
                    '</tr>';
            }
            $("#Table tbody").html(tbody);
        }
    });
}

