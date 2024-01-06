<?php
include_once '../conexion/conexion.php';

if (isset($_POST['idProspecto'])) {
    $id = intval($_POST['idProspecto']); 
    if ($id > 0) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $edad = $_POST['edad'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $selectCar = $_POST['selectCar'];
        $selectModel = $_POST['selectModel'];

        // Llama a la función para editar el registro
        $result = editData($id, $nombre, $apellido, $edad, $telefono, $email, $selectCar, $selectModel);

        // Verifica el resultado de la operación de edición
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            error_log('Error al editar el registro. ID: ' . $id);
            echo json_encode(['success' => false, 'message' => 'Error al editar el registro.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID no válido proporcionado en la solicitud.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado en la solicitud.']);
}
