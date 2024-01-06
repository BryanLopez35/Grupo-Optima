<?php
class DBManager
{
    private $host = '192.168.1.69';
    private $usuario = 'root';
    private $contrasena = 'pr3cis!onpp';
    private $base_datos = 'optima';
    private $conexion;

    // Constructor para establecer la conexion
    public function __construct()
    {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->base_datos);

        // Verificar la conexión
        if ($this->conexion->connect_error) {
            die("Error de conexion: " . $this->conexion->connect_error);
        }
    }

    // Destructor para cerrar la conexion
    public function __destruct()
    {
        $this->conexion->close();
    }

    // Funcion para ejecutar una consulta
    public function ejecutarQuery($consulta)
    {
        $datarow = $this->conexion->query($consulta);
        return $datarow;
    }

    // Funcion para obtener un solo registro
    public function DataRow($consulta)
    {
        $data = $this->ejecutarQuery($consulta);

        if ($data->num_rows > 0) {
            return $data->fetch_assoc();
        } else {
            return null;
        }
    }

    // Funcion para obtener una coleccion de registros
    public function DataRows($consulta)
    {
        $data = $this->ejecutarQuery($consulta);

        if ($data->num_rows > 0) {
            return $data;
        } else {
            return null;
        }
    }
}

// Uso de la clase DBManager
$dbManager = new DBManager();
//echo "Conexion exitosa a la base de datos.";

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
