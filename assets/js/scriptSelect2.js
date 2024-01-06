$(document).ready(function () {
    $('#selectCar').select2({
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
});