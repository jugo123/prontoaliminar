<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.html');
    exit();
}
include 'cabecera.php';
// Verifica si se ha proporcionado un ID de trabajador
if (!isset($_GET['id_trabajador'])) {
    // Redirecciona si no se proporcionó un ID válido
    header('Location: informacion_trabajador.php');
    exit();
}

$id_trabajador = $_GET['id_trabajador'];

// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Verifica si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario y los escapa para evitar inyecciones SQL
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);

    // Actualiza los datos en la tabla datos_personales
    $sql = "UPDATE datos_personales SET nombre='$nombre', genero='$genero', direccion='$direccion', telefono='$telefono' WHERE id=$id_trabajador";

    if ($conn->query($sql) === TRUE) {
        echo "Datos personales actualizados exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cierra la conexión
    $conn->close();
}

// Puedes realizar una consulta para obtener los detalles personales del trabajador con el ID proporcionado y prellenar el formulario con esos detalles
// Luego, cuando el usuario envíe el formulario, los datos actualizados se enviarán a esta misma página para actualizar el registro
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos Personales</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Editar Datos Personales</h2>
        <!-- Formulario para editar los datos personales -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="genero">Género:</label>
                <select class="form-control" id="genero" name="genero" required>
                    <option value="">Seleccionar</option>
                    <option value="Masculino">Hombre cis</option>
                    <option value="Femenino">Mujer cis</option>
                    <option value="Hombre trans">Hombre trans</option>
                    <option value="Mujer trans">Mujer trans</option>
                    <option value="No binario">No binario</option>
                </select>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Datos Personales</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
