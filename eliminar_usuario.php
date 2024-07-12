<?php
// Verificar si se ha enviado un ID de usuario por método POST
if(isset($_POST['id'])) {
    // Incluir el archivo de conexión
    include("conexion.php");

    // Obtener el ID del usuario
    $id = $_POST['id'];

    // Consulta SQL para eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Si la eliminación se realiza correctamente, devolver una respuesta de éxito
        echo "Usuario eliminado exitosamente.";
    } else {
        // Si hay un error en la eliminación, devolver un mensaje de error
        echo "Error al eliminar usuario: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se proporciona un ID de usuario, devolver un mensaje de error
    echo "No se proporcionó un ID de usuario.";
}
?>
