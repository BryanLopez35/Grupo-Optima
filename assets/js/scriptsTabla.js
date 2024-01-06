$(document).ready(function () {

    // Configuracion de la DataTable
    var dataTable = $('#tablaRegistros').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
        },
        columns: [
            { data: 'idProspecto' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'edad' },
            { data: 'telefono' },
            { data: 'email' },
            { data: 'marcaAuto' },
            { data: 'modeloAuto' },
            {
                data: null,
                render: function (data, type, row) {
                    return '<button class="btn btn-sm btn-warning edit-btn" data-id="' + data.idProspecto + '"><i class="material-icons">edit</i></button>';
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    return '<button class="btn btn-sm btn-danger delete-btn" data-id="' + data.idProspecto + '"><i class="material-icons">delete</i></button>';
                }
            }
        ],
        columnDefs: [
            {
                targets: [0], // Se selecciona la columna idPropescto para ocultarla
                visible: false,
            },
        ],
        scrollX: true
    });

    // Cargar datos en la DataTable
    $.ajax({
        url: 'accesodatos/obtenerDatos.php',
        dataType: 'json',
        success: function (data) {
            // Agregar datos 
            dataTable.clear().rows.add(data).draw();
        }
    });

    // Manejo de evento editar
    $('#tablaRegistros').on('click', '.edit-btn', function () {
        var idProspecto = $(this).data('id');
        //console.log('ID a editar:', idProspecto); // Mensaje de depuracion

        $.ajax({
            url: 'accesodatos/datosProspecto.php',
            method: 'POST',
            data: { id: idProspecto },
            dataType: 'json',
            success: function (responseData) {
                // Verifica si la respuesta tiene datos
                if (responseData.data) {
                    var prospecto = responseData.data;

                    // Llenar selectores
                    $('#selectCar').empty().append(new Option(prospecto.marcaAuto, prospecto.idAutoInteres, true, true)).trigger('change');
                    $('#selectModel').empty().append(new Option(prospecto.modeloAuto, prospecto.idModeloInteres, true, true)).trigger('change');

                    // Asigna valores al formulario
                    $('#nombre').val(prospecto.nombre);
                    $('#apellido').val(prospecto.apellido);
                    $('#edad').val(prospecto.edad);
                    $('#telefono').val(prospecto.telefono);
                    $('#email').val(prospecto.email);
                    $('#idProspecto').val(idProspecto);

                    // Inicializar Select2
                    $('#selectCar').select2({
                        width: '100%',
                        ajax: {
                            url: 'accesodatos/autos.php',
                            dataType: 'json',
                            processResults: function (data) {
                                return {
                                    results: data.map(function (obj) {
                                        return {
                                            id: obj.idAuto,
                                            text: obj.marca
                                        };
                                    })
                                };
                            }
                        }
                    });


                    $('#selectCar').on('change', function () {
                        var selectedCarId = $(this).val();

                        // Limpiar y deshabilitar selectModel
                        $('#selectModel').empty().prop('disabled', true);

                        // Cargar modelos conforme al auto seleccionado en selectCar
                        if (selectedCarId) {
                            $('#selectModel').prop('disabled', false).select2({
                                ajax: {
                                    url: 'accesodatos/modelos.php?carId=' + selectedCarId,
                                    dataType: 'json',
                                    processResults: function (data) {
                                        return {
                                            results: data.map(function (obj) {
                                                return {
                                                    id: obj.idModelo,
                                                    text: obj.modelo
                                                };
                                            })
                                        };
                                    }
                                }
                            });
                        }
                    });

                    // Abre el modal
                    $('#editarModal').modal('show');

                } else {
                    console.log('Datos del prospecto no encontrados.');
                }
            },
            error: function (error) {
                console.log('Error al obtener la información del prospecto:', error);
            }
        });
    });

    $('#tablaRegistros').on('click', '.delete-btn', function () {
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger mr-2"
            },
            buttonsStyling: false
        });

        var idProspecto = $(this).data('id');
        console.log('ID a eliminar:', idProspecto); // Agrega este console.log
        // Confirmar eliminación con SweetAlert2
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lógica para eliminar el registro según el ID
                $.ajax({
                    url: 'accesodatos/eliminarRegistro.php',
                    method: 'POST',
                    data: { id: idProspecto },
                    dataType: 'json', // Esperamos una respuesta en formato JSON
                    success: function (responseData) {
                        swalWithBootstrapButtons.fire(
                            "Registro eliminado",
                            "El registro fue removido",
                            "success"
                        ).then(function () {
                            // Recargar la página
                            location.reload();
                        });
                    },
                    error: function () {
                        swalWithBootstrapButtons.fire(
                            "Error",
                            "La eliminación falló",
                            "error"
                        );
                    }
                });
            }
        });
    });
});
(function () {
    'use strict';

    window.addEventListener('load', function () {
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger mr-2"
            },
            buttonsStyling: false
        });

        var forms = document.getElementsByClassName('needs-validation');

        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                if (form.checkValidity() === false) {
                    event.stopPropagation();
                    swalWithBootstrapButtons.fire(
                        "CAMPOS VACIOS",
                        "Por favor llene los campos indicados",
                        "error"
                    );
                } else {
                    // Recopilar datos del formulario
                    var data = {
                        nombre: $('#nombre').val(),
                        apellido: $('#apellido').val(),
                        edad: $('#edad').val(),
                        telefono: $('#telefono').val(),
                        email: $('#email').val(),
                        selectCar: $('#selectCar').val(),
                        selectModel: $('#selectModel').val(),
                        idProspecto: $('#idProspecto').val()
                    };

                    console.log(data);

                    $.ajax({
                        dataType: 'json',
                        type: 'post',
                        url: 'accesodatos/editarProspecto.php',
                        data: data,
                        success: function (responseData) {
                            swalWithBootstrapButtons.fire(
                                "Registro exitoso",
                                "El registro fue actualizado",
                                "success"
                            ).then(function () {
                                // Recargar la página
                                location.reload();
                            });
                        },
                        error: function () {
                            swalWithBootstrapButtons.fire(
                                "Error",
                                "El registro falló",
                                "error"
                            );
                        }
                    });
                }

                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
