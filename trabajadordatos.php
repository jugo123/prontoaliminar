<?php
session_start();

// Verificar si el trabajador ha iniciado sesión
if (!isset($_SESSION['rut'])) {
    header("Location: trabajadorlogin.php");
    exit();
}

// Obtener el RUT del trabajador
$rut = $_SESSION['rut'] ?? '';

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Consultar los datos personales del trabajador
$query = "SELECT * FROM datos_personales WHERE rut = '$rut'";
$result = $conexion->query($query);

if ($result && $result->num_rows > 0) {
    $datos_personales = $result->fetch_assoc();
} else {
    // Manejar el caso en que no se encuentren los datos personales del trabajador
    $error = "Error al cargar los datos personales.";
}

// Manejar el formulario de actualización de datos personales
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el formulario
    $nombre = $_POST['nombre'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';

    // Actualizar los datos personales en la base de datos
    $update_query = "UPDATE datos_personales SET nombre = '$nombre', direccion = '$direccion', telefono = '$telefono' WHERE rut = '$rut'";
    $update_result = $conexion->query($update_query);

    if ($update_result) {
        // Redireccionar a la misma página para mostrar el mensaje de éxito
        header("Location: trabajador.php?status=success");
        exit();
    } else {
        $error = "Error al actualizar los datos personales.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil del Trabajador</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h1 class="text-center mb-4">Perfil del Trabajador</h1>
  <form method="POST">
    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos_personales['nombre']; ?>" required>
    </div>
    <div class="form-group">
      <label for="direccion">Dirección:</label>
      <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $datos_personales['direccion']; ?>" required>
    </div>
    <div class="form-group">
      <label for="telefono">Teléfono:</label>
      <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $datos_personales['telefono']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    <?php if (isset($error)) { ?>
        <div class="text-danger mt-2"><?php echo $error; ?></div>
    <?php } ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success') { ?>
        <div class="text-success mt-2">Datos actualizados correctamente.</div>
    <?php } ?>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
