<!DOCTYPE html>
<html lang="es">
<?php include_once './includes/head.php'; ?>
<?php include_once './includes/header.php'; ?>

<body>
    <section id="form-container" class="container mt-4 mb-5">
        <form class="needs-validation" novalidate id="AddData-form">
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                    <div class="invalid-feedback">
                        Por favor ingrese su nombre.
                    </div>
                    <div class="valid-feedback">
                        Se ve bien!
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                    <div class="invalid-feedback">
                        Por favor ingrese su apellido.
                    </div>
                    <div class="valid-feedback">
                        Se ve bien!
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="edad">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad" required min="0">
                    <div class="invalid-feedback">
                        Por favor ingrese una edad válida.
                    </div>
                    <div class="valid-feedback">
                        Se ve bien!
                    </div>
                </div>
                <div class="col-md-3 mb-3">
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
            </div>
            <div class="form-row">
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
                <div class="col-md-3 mb-3">
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
                <div class="col-md-3 mb-3">
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
            <div class="text-center">
                <button class="btn btn-primary" type="submit">Registrar</button>
            </div>
        </form>
    </section>

    <?php include_once './includes/footer.php'; ?>
    <?php include_once './includes/js.php'; ?>
    <script src="./assets/js/scriptSelect2.js"></script>
    <script src="./assets/js/scriptsRegistro.js"></script>
</body>

</html>