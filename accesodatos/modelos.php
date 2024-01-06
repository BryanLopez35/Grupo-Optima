<?php
include_once '../conexion/conexion.php';

// Obtener la marca seleccionada desde la URL
$carId = isset($_GET['carId']) ? $_GET['carId'] : null;

// Verificar si se proporciona un ID de auto válido
if ($carId !== null) {
    // Obtener modelos relacionados con la marca seleccionada
    $resultModels = getModelsByCarId($carId);

    // Verificar si la consulta fue exitosa
    if ($resultModels) {
        // Crear un array para almacenar los modelos
        $modelos = [];

        // Obtener modelos y almacenar en el array
        while ($filaModelo = $resultModels->fetch_assoc()) {
            $modelos[] = $filaModelo;
        }

        // Verificar si hay datos antes de convertir a JSON
        if (!empty($modelos)) {
            // Convertir el array a formato JSON y devolverlo 
            echo json_encode($modelos);
        } else {
            echo json_encode(['error' => 'No se encontraron modelos para la marca seleccionada.']);
        }
    } else {
        echo json_encode(['error' => 'Error al obtener datos de modelos.']);
    }
} else {
    echo json_encode(['error' => 'ID de auto no proporcionado.']);
}
?>
