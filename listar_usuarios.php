<?php
// Incluir el archivo de conexión
include("conexion.php");

// Iniciar sesión (si es necesario)
// session_start();

// Consulta para obtener la lista de usuarios
$sql = "SELECT id, correo FROM usuarios";
$resultado = $conn->query($sql);

// Array para almacenar los datos de los usuarios
$usuarios = [];

// Verificar si la consulta retornó resultados
if ($resultado->num_rows > 0) {
    // Recorrer los resultados y almacenarlos en el array
    while ($row = $resultado->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Retornar los datos de los usuarios en formato JSON
echo json_encode($usuarios);
?>
