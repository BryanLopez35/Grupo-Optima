<?php
include_once '../conexion/conexion.php'; 

// Obtener autos de la función getCars()
$resultCars = getCars();

// Verificar si la consulta fue exitosa
if ($resultCars) {
    // Crear un array para almacenar los autos
    $cars = [];

    // Obtener autos y almacenar en el array
    while ($row = $resultCars->fetch_assoc()) {
        $cars[] = $row;
    }

    // Verificar si hay datos antes de convertir a JSON
    if (!empty($cars)) {
        // Convertir el array a formato JSON y devolverlo 
        echo json_encode($cars);
    } else {
        echo json_encode(['error' => 'No se encontraron autos.']);
    }
} else {
    echo json_encode(['error' => 'Error al obtener datos de autos.']);
}

