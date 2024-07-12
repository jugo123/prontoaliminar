<?php
// Parte donde se incluye el archivo de conexión
include("conexion.php");

// Acá se parte la sesión, o sea, se inicia
session_start();

// Revisa si no hay una sesión activa
if (!isset($_SESSION['id'])) {
    // Si no hay sesión, tira un mensaje de error en formato JSON y se sale de la ejecución
    echo json_encode(['error' => 'No session']);
    exit();
}

// Se saca el ID del trabajador desde la sesión
$id_trabajador = $_SESSION['id'];

// Consulta pa' sacar los datos personales, familiares y laborales del trabajador
$sql = "SELECT cf.nombre AS carga_nombre, cf.parentesco, cf.genero AS carga_genero, cf.rut AS carga_rut,
    dp.nombre AS nombre, dp.genero, dp.direccion, dp.telefono,
    dl.cargo, dl.fecha_ingreso, dl.area, dl.departamento
    FROM cargas_familiares cf
    LEFT JOIN datos_personales dp ON cf.trabajador_id = dp.id
    LEFT JOIN datos_laborales dl ON cf.trabajador_id = dl.trabajador_id
    WHERE cf.trabajador_id = $id_trabajador";
$result = $conn->query($sql);

// Arreglo pa' guardar los datos
$data = [];

// Revisa si hay resultados en la consulta
if ($result->num_rows > 0) {
    // Recorre los resultados y los va metiendo en el arreglo de datos personales
    while($row = $result->fetch_assoc()) {
        $data['personales'][] = $row;
    }
}

// Consulta pa' obtener los contactos de emergencia del trabajador
$sql_contactos = "SELECT nombre, relacion, telefono, id
                  FROM contactos_emergencia 
                  WHERE trabajador_id = $id_trabajador";
$result_contactos = $conn->query($sql_contactos);

// Revisa si hay resultados en la consulta de los contactos de emergencia
if ($result_contactos->num_rows > 0) {
    // Recorre los resultados y los va metiendo en el arreglo de contactos de emergencia
    while($row_contactos = $result_contactos->fetch_assoc()) {
        $data['contactos'][] = $row_contactos;
    }
}

// Consulta para obtener las cargas familiares del trabajador
$sql_cargas = "SELECT nombre, parentesco, genero, rut
               FROM cargas_familiares
               WHERE trabajador_id = $id_trabajador";
$result_cargas = $conn->query($sql_cargas);

// Revisa si hay resultados en la consulta de las cargas familiares
if ($result_cargas->num_rows > 0) {
    // Recorre los resultados y los va metiendo en el arreglo de cargas familiares
    while($row_cargas = $result_cargas->fetch_assoc()) {
        $data['cargas'][] = $row_cargas;
    }
}

// Muestra los datos en formato JSON
echo json_encode($data);

// Cierra la conexión a la base de datos
$conn->close();
?>
