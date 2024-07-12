<?php
// Incluir el archivo de conexión
include("conexion.php");

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST["id"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // Actualizar los datos del usuario en la base de datos
    $sql = "UPDATE usuarios SET correo = '$correo', contrasena = '$contrasena' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Si la actualización se realiza correctamente, redirigir a admin.php
        header("Location: admin.php");
        exit();
    } else {
        // Si hay un error en la actualización, mostrar un mensaje de error
        echo "Error al actualizar usuario: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>