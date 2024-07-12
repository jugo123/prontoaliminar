<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

// Inicializar variables
$rut = $nombre = $genero = $telefono = $direccion = $cargo = $departamento = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['rut'])) {
    $rut = $_GET['rut'];

    // Consulta SQL para obtener los datos del trabajador
    $sql_select = "SELECT dp.rut, dp.nombre, dp.genero, dp.telefono, dp.direccion, dl.cargo, dl.departamento
                   FROM datos_personales dp
                   INNER JOIN datos_laborales dl ON dp.id = dl.trabajador_id
                   WHERE dp.rut = ?";
    $stmt = $conn->prepare($sql_select);
    $stmt->bind_param("s", $rut);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verifica si se obtuvieron resultados
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rut = $row['rut'];
        $nombre = $row['nombre'];
        $genero = $row['genero'];
        $telefono = $row['telefono'];
        $direccion = $row['direccion'];
        $cargo = $row['cargo'];
        $departamento = $row['departamento'];
    } else {
        echo '<div class="alert alert-danger" role="alert">No se encontró el trabajador.</div>';
        $stmt->close();
        $conn->close();
        exit;
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario de edición
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];

    // Iniciar transacción para asegurar operaciones atómicas
    $conn->begin_transaction();

    try {
        // Actualizar datos personales
        $sql_update_dp = "UPDATE datos_personales SET nombre = ?, genero = ?, telefono = ?, direccion = ? WHERE rut = ?";
        $stmt_dp = $conn->prepare($sql_update_dp);
        $stmt_dp->bind_param("sssss", $nombre, $genero, $telefono, $direccion, $rut);
        $stmt_dp->execute();
        $stmt_dp->close();

        // Actualizar datos laborales
        $sql_update_dl = "UPDATE datos_laborales SET cargo = ?, departamento = ? WHERE trabajador_id = (SELECT id FROM datos_personales WHERE rut = ?)";
        $stmt_dl = $conn->prepare($sql_update_dl);
        $stmt_dl->bind_param("sss", $cargo, $departamento, $rut);
        $stmt_dl->execute();
        $stmt_dl->close();

        // Confirmar la transacción
        $conn->commit();

        echo '<div class="alert alert-success" role="alert">El trabajador ha sido actualizado correctamente.</div>';

    } catch (Exception $e) {
        // Rollback en caso de error
        $conn->rollback();

        echo '<div class="alert alert-danger" role="alert">Error al intentar actualizar al trabajador: ' . $e->getMessage() . '</div>';
    }
}

$conn->close(); // Cierra la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Trabajador</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h1 class="text-center mb-4">Editar Trabajador</h1>
  <form action="editar_trabajador.php" method="post">
    <div class="form-group">
      <label for="rut">RUT</label>
      <input type="text" class="form-control" id="rut" name="rut" value="<?php echo htmlspecialchars($rut); ?>" readonly>
    </div>
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
    </div>
    <div class="form-group">
      <label for="genero">Sexo</label>
      <select class="form-control" id="genero" name="genero" required>
        <option value="M" <?php echo $genero == 'M' ? 'selected' : ''; ?>>Masculino</option>
        <option value="F" <?php echo $genero == 'F' ? 'selected' : ''; ?>>Femenino</option>
      </select>
    </div>
    <div class="form-group">
      <label for="telefono">Teléfono</label>
      <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" required>
    </div>
    <div class="form-group">
      <label for="direccion">Dirección</label>
      <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" required>
    </div>
    <div class="form-group">
      <label for="cargo">Cargo</label>
      <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo htmlspecialchars($cargo); ?>" required>
    </div>
    <div class="form-group">
      <label for="departamento">Departamento</label>
      <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo htmlspecialchars($departamento); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="lista_trabajadores.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
