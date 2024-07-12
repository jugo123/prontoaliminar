<?php
// archivo: eliminar_contacto_emergencia.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Incluir conexión a la base de datos
include("conexion.php");

// Verificar si se ha enviado un ID válido
if(isset($_GET['id_contacto']) && !empty($_GET['id_contacto'])) {
    // Sanitizar el ID del contacto
    $id_contacto = $_GET['id_contacto'];

    // Preparar la consulta SQL para eliminar el contacto de emergencia
    $sql = "DELETE FROM contactos_emergencia WHERE id = ?";
    
    // Preparar la sentencia
    $stmt = $conn->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bind_param("i", $id_contacto);
    
    // Ejecutar la consulta
    if($stmt->execute()) {
        // Redirigir de vuelta a la página principal o a donde sea necesario
        header("Location: vista_trabajador.php");
        exit();
    } else {
        echo "Error al eliminar el contacto de emergencia.";
    }

    // Cerrar la sentencia
    $stmt->close();
} else {
    echo "ID de contacto no válido.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>