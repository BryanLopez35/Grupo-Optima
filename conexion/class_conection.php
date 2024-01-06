<?php 

function getCars()
{
    global $dbManager;

    $consulta = "CALL getCars();";

    return $dbManager->DataRows($consulta);
}

function getModels()
{
    global $dbManager;
    $consulta = "CALL getModels();";

    return $dbManager->DataRows($consulta);
}

function getModelsByCarId($carId)
{
    global $dbManager;

    $consulta = "CALL getModelsByCarId('$carId');";

    return $dbManager->DataRows($consulta);
}

function registrar($nombre, $apellido, $edad, $telefono, $email, $selectCar, $selectModel)
{
    global $dbManager;

    $consulta = "INSERT INTO prospectos (nombre, apellido, edad, telefono, email, idAutoInteres, idModeloInteres) 
                 VALUES ('$nombre', '$apellido', $edad, '$telefono', '$email', $selectCar, $selectModel)";

    $resultado = $dbManager->ejecutarQuery($consulta);

    if ($resultado) {
        return true; // Exito
    } else {
        return false; // Ocurrio un error al insertar
    }
}

function editData($id, $nombre, $apellido, $edad, $telefono, $email, $selectCar, $selectModel)
{
    global $dbManager;

    $consulta = "UPDATE prospectos 
                 SET nombre = '$nombre', 
                     apellido = '$apellido', 
                     edad = $edad, 
                     telefono = '$telefono', 
                     email = '$email', 
                     idAutoInteres = $selectCar, 
                     idModeloInteres = $selectModel 
                 WHERE idProspecto = '$id'";

    $resultado = $dbManager->ejecutarQuery($consulta);

    if ($resultado) {
        return true; // Exito
    } else {
        return false; // Ocurrio un error al insertar
    }
}


function getData()
{
    global $dbManager;

    $consulta = "CALL getData();";

    return $dbManager->DataRows($consulta);
}

function deleteData($id)
{
    global $dbManager;

    $consulta = "DELETE FROM prospectos WHERE idProspecto = $id";

    return $dbManager->ejecutarQuery($consulta);
}

function getDataProspecto($id)
{
    global $dbManager;

    $consulta = "CALL getDataProspecto('$id');";

    $result = $dbManager->ejecutarQuery($consulta);

    if ($result) {
        // Devuelve los datos como un array 
        return $result->fetch_assoc();
    } else {
        return null; // Devuelve null si hay un error
    }
}
