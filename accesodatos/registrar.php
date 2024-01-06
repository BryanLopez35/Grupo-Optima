<?php
include_once '../conexion/conexion.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$selectCar = $_POST['selectCar'];
$selectModel = $_POST['selectModel'];


registrar($nombre, $apellido, $edad, $telefono, $email, $selectCar, $selectModel);

// Devolver una respuesta
$response = ['success' => true, 'message' => 'Registro exitoso'];
echo json_encode($response);
