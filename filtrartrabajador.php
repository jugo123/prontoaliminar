<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Filtrar Trabajadores</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h1 class="text-center mb-4">Filtrar Trabajadores</h1>
  <form method="POST">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="filtroSexo">Sexo:</label>
        <select class="form-control" id="filtroSexo" name="filtroSexo">
          <option value="">Todos</option>
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="filtroCargo">Cargo:</label>
        <input type="text" id="filtroCargo" name="filtroCargo" class="form-control" placeholder="Ingrese el cargo">
      </div>
      <div class="form-group col-md-2">
        <label for="filtroArea">Área:</label>
        <input type="text" id="filtroArea" name="filtroArea" class="form-control" placeholder="Ingrese el área">
      </div>
      <div class="form-group col-md-2">
        <label for="filtroDepartamento">Departamento:</label>
        <input type="text" id="filtroDepartamento" name="filtroDepartamento" class="form-control" placeholder="Ingrese el departamento">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Filtrar</button>
    <button type="button" class="btn btn-secondary" onclick="reiniciarFiltros()">Reiniciar</button>
    <a href="opciones.html" class="btn btn-info">Volver al Inicio</a>
  </form>
</div>

<!-- Modal de edición de trabajador -->
<div class="modal fade" id="modalEditarTrabajador" tabindex="-1" role="dialog" aria-labelledby="modalEditarTrabajadorLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarTrabajadorLabel">Editar Trabajador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario de edición -->
        <form id="formEditarTrabajador">
          <div class="form-group">
            <label for="editRut">RUT:</label>
            <input type="text" class="form-control" id="editRut" name="editRut" readonly>
          </div>
          <div class="form-group">
            <label for="editNombre">Nombre:</label>
            <input type="text" class="form-control" id="editNombre" name="editNombre" required>
          </div>
          <div class="form-group">
            <label for="editGenero">Género:</label>
            <select class="form-control" id="editGenero" name="editGenero" required>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>
          </div>
          <div class="form-group">
            <label for="editCargo">Cargo:</label>
            <input type="text" class="form-control" id="editCargo" name="editCargo" required>
          </div>
          <div class="form-group">
            <label for="editArea">Área:</label>
            <input type="text" class="form-control" id="editArea" name="editArea" required>
          </div>
          <div class="form-group">
            <label for="editDepartamento">Departamento:</label>
            <input type="text" class="form-control" id="editDepartamento" name="editDepartamento" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="guardarEdicion()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<?php
include 'conexion.php'; // Incluir el archivo de conexión

// Manejo de las acciones de AJAX
if (isset($_GET['accion'])) {
  $accion = $_GET['accion'];
  
  if ($accion == 'obtener') {
    $rut = $_GET['rut'];
    obtenerTrabajador($conn, $rut);
  } elseif ($accion == 'actualizar') {
    actualizarTrabajador($conn);
  }
  exit;
}

// Función para obtener los datos de un trabajador
function obtenerTrabajador($conn, $rut) {
  $sql = "SELECT dp.rut, dp.nombre, dp.genero, dl.cargo, dl.area, dl.departamento 
          FROM datos_personales dp 
          INNER JOIN datos_laborales dl ON dp.id = dl.trabajador_id 
          WHERE dp.rut = '$rut'";
  
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $trabajador = $result->fetch_assoc();
    echo json_encode($trabajador);
  } else {
    echo json_encode(['error' => 'No se encontró el trabajador.']);
  }
}

// Función para actualizar los datos de un trabajador
function actualizarTrabajador($conn) {
  $rut = $_POST['editRut'];
  $nombre = $_POST['editNombre'];
  $genero = $_POST['editGenero'];
  $cargo = $_POST['editCargo'];
  $area = $_POST['editArea'];
  $departamento = $_POST['editDepartamento'];

  // Iniciar transacción
  $conn->begin_transaction();

  try {
    // Actualizar datos personales
    $sql = "UPDATE datos_personales 
            SET nombre = '$nombre', genero = '$genero' 
            WHERE rut = '$rut'";
    $conn->query($sql);

    // Obtener el ID del trabajador
    $sql = "SELECT id FROM datos_personales WHERE rut = '$rut'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $trabajador_id = $row['id'];

    // Actualizar datos laborales
    $sql = "UPDATE datos_laborales 
            SET cargo = '$cargo', area = '$area', departamento = '$departamento' 
            WHERE trabajador_id = '$trabajador_id'";
    $conn->query($sql);

    // Commit si todas las actualizaciones son exitosas
    $conn->commit();
    echo "Trabajador actualizado exitosamente.";
  } catch (Exception $e) {
    // Rollback en caso de error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
  }
}

// Manejo de la lógica de filtrado y visualización de trabajadores
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['editRut'])) {
  $filtroSexo = $_POST['filtroSexo'] ?? '';
  $filtroCargo = $_POST['filtroCargo'] ?? '';
  $filtroArea = $_POST['filtroArea'] ?? '';
  $filtroDepartamento = $_POST['filtroDepartamento'] ?? '';

  $sql = "SELECT dp.rut, dp.nombre, dp.genero, dl.cargo
          FROM datos_personales dp
          INNER JOIN datos_laborales dl ON dp.id = dl.trabajador_id";

  $condiciones = [];
  if (!empty($filtroSexo)) {
    $condiciones[] = "dp.genero = '$filtroSexo'";
  }
  if (!empty($filtroCargo)) {
    $condiciones[] = "dl.cargo = '$filtroCargo'";
  }
  if (!empty($filtroArea)) {
    $condiciones[] = "dl.area = '$filtroArea'";
  }
  if (!empty($filtroDepartamento)) {
    $condiciones[] = "dl.departamento = '$filtroDepartamento'";
  }

  if (!empty($condiciones)) {
    $sql .= " WHERE " . implode(" AND ", $condiciones);
  }

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo '<div class="container mt-4">';
    echo '<h1 class="text-center mb-4">Resultados del Filtro</h1>';
    echo '<table class="table table-bordered">';
    echo '<thead class="thead-dark"><tr><th scope="col">RUT</th><th scope="col">Nombre</th><th scope="col">Género</th><th scope="col">Cargo
</th><th scope="col">Acciones</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td>' . $row["rut"] . '</td>';
      echo '<td>' . $row["nombre"] . '</td>';
      echo '<td>' . $row["genero"] . '</td>';
      echo '<td>' . $row["cargo"] . '</td>';
      echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
  } else {
    echo '<div class="container mt-4">';
    echo '<h1 class="text-center mb-4">Resultados del Filtro</h1>';
    echo '<p>No se encontraron trabajadores con los criterios de búsqueda.</p>';
    echo '</div>';
  }
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

  function reiniciarFiltros() {
    $('#filtroSexo').val('');
    $('#filtroCargo').val('');
    $('#filtroArea').val('');
    $('#filtroDepartamento').val('');
    $('form').submit(); // Envía el formulario para reiniciar la página
  }
</script>
</body>
</html>

