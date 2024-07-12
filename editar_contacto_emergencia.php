<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';
include 'cabecera.php';

// Verifica si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario y los escapa para evitar inyecciones SQL
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $relacion = mysqli_real_escape_string($conn, $_POST['relacion']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);

    // Recibe el ID del contacto de emergencia
    $id_contacto = $_GET['id_contacto'];

    // Actualiza los datos en la tabla contactos_emergencia
    $sql = "UPDATE contactos_emergencia SET nombre='$nombre', relacion='$relacion', telefono='$telefono' WHERE id=$id_contacto";

    if ($conn->query($sql) === TRUE) {
        echo "Contacto de emergencia actualizado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cierra la conexión
    $conn->close();
}

// Puedes realizar consultas para obtener los detalles del contacto de emergencia con el ID proporcionado y prellenar el formulario con esos detalles
// Luego, cuando el usuario envíe el formulario, los datos se enviarán a esta misma página para actualizar el registro
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contacto de Emergencia</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Editar Contacto de Emergencia</h2>
        <!-- Formulario para editar el contacto de emergencia -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="relacion">Relación:</label>
                <input type="text" class="form-control" id="relacion" name="relacion" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Contacto</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
