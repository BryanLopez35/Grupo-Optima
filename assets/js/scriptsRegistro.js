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
                    var data = new FormData(form);

                    $.ajax({
                        dataType: 'json',
                        type: 'post',
                        url: 'accesodatos/registrar.php',
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function (responseData) {
                            swalWithBootstrapButtons.fire(
                                "Registro exitoso",
                                "El registro fue exitoso",
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
