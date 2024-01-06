<?php
include_once '../conexion/conexion.php';


if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Convierte el valor a entero
    if ($id > 0) {
        // Llama a la función para eliminar el registro
        $result = deleteData($id);

        // Verifica el resultado de la operación de eliminación
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            error_log('Error al eliminar el registro. ID: ' . $id);
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el registro.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID no válido proporcionado en la solicitud.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado en la solicitud.']);
}
