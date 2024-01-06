<?php
include_once '../conexion/conexion.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    if ($id > 0) {
        // Mensajes de depuración
        //error_log('ID recibido para consultar: ' . $id);

        // Llama a la función para consultar el registro
        $result = getDataProspecto($id);

        // Verifica el resultado de la consulta
        if ($result) {
            echo json_encode(['success' => true, 'data' => $result]);
        } else {
            error_log('Error al consultar el registro. ID: ' . $id);
            echo json_encode(['success' => false, 'message' => 'Error al consultar el registro.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID no válido proporcionado en la solicitud.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado en la solicitud.']);
}
