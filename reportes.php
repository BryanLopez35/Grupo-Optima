<!DOCTYPE html>
<html lang="es">
<?php include_once './includes/head.php'; ?>
<?php include_once './includes/header.php'; ?>

<body>
    <div class="container modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate id="AddData-form">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese su nombre.
                                </div>
                                <div class="valid-feedback">
                                    Se ve bien!
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese su apellido.
                                </div>
                                <div class="valid-feedback">
                                    Se ve bien!
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edad">Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad" required min="0">
                                <div class="invalid-feedback">
                                    Por favor ingrese una edad válida.
                                </div>
                                <div class="valid-feedback">
                                    Se ve bien!
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono">Número de Teléfono</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="material-icons">phone</i></span>
                                    </div>
                                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingrese su número telefónico" required>
                                    <div class="invalid-feedback">
                                        Por favor ingrese un número telefónico válido (10 dígitos numéricos).
                                    </div>
                                    <div class="valid-feedback">
                                        Se ve bien!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Correo Electronico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese su correo electronico.
                                </div>
                                <div class="valid-feedback">
                                    Se ve bien!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="selectCar">Auto de interes</label>
                                <select class="js-select-auto form-control" id="selectCar" name="selectCar" required>
                                    <option value="" selected disabled>Seleccione un auto</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, seleccione un auto válido.
                                </div>
                                <div class="valid-feedback">
                                    Se ve bien!
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="selectModel">Modelo de interes</label>
                                <select class="js-select-auto form-control" id="selectModel" name="selectModel" required>
                                    <option value="" selected disabled>Seleccione un modelo</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, seleccione un modelo válido.
                                </div>
                                <div class="valid-feedback">
                                    Se ve bien!
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="idProspecto" name="idProspecto" value="">
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Actualizar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <section id="tabla-container" class="container mt-4">
        <table id="tablaRegistros" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>

    <?php include_once './includes/footer.php'; ?>
    <?php include_once './includes/js.php'; ?>
    <script src="./assets/js/scriptsTabla.js"></script>
</body>

</html>