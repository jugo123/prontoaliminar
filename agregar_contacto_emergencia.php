<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';
include 'cabecera.php';
// Verifica si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
// Recibe los datos del formulario y los escapa para evitar inyecciones SQL
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $relacion = mysqli_real_escape_string($conn, $_POST['relacion']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);

    $id_trabajador = $_GET['id_trabajador'];

    // Inserta los datos en la tabla contactos_emergencia
    $sql = "INSERT INTO contactos_emergencia (trabajador_id, nombre, relacion, telefono) VALUES ($id_trabajador, '$nombre', '$relacion', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "Contacto de emergencia agregado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cierra la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Contacto de Emergencia</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Agregar Nuevo Contacto de Emergencia</h2>
        <!-- Formulario para agregar un nuevo contacto de emergencia -->
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
            <button type="submit" class="btn btn-primary">Agregar Contacto</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
$id_trabajador = $_GET['id_trabajador'];
?>
