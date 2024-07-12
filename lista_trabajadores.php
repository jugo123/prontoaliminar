<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Trabajadores</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h1 class="text-center mb-4">Lista de Trabajadores</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">RUT</th>
        <th scope="col">Nombre</th>
        <th scope="col">Sexo</th>
        <th scope="col">Cargo</th>
        <th scope="col">Acciones</th> <!-- Nueva columna para los botones de acción -->
      </tr>
    </thead>
    <tbody>
      <?php
      include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

      // Verificar si se ha enviado el formulario de eliminación
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rut'])) {
          // Procesar el formulario de eliminación
          $rut = $_POST['rut'];

          // Iniciar transacción para asegurar operaciones atómicas
          $conn->begin_transaction();

          try {
              // Eliminar primero de datos_laborales
              $sql_delete_dl = "DELETE FROM datos_laborales WHERE trabajador_id = (SELECT id FROM datos_personales WHERE rut = ?)";
              $stmt_dl = $conn->prepare($sql_delete_dl);
              $stmt_dl->bind_param("s", $rut);
              $stmt_dl->execute();
              $stmt_dl->close();

              // Eliminar luego de cargas_familiares
              $sql_delete_cf = "DELETE FROM cargas_familiares WHERE trabajador_id = (SELECT id FROM datos_personales WHERE rut = ?)";
              $stmt_cf = $conn->prepare($sql_delete_cf);
              $stmt_cf->bind_param("s", $rut);
              $stmt_cf->execute();
              $stmt_cf->close();

              // Eliminar después de contactos_emergencia
              $sql_delete_ce = "DELETE FROM contactos_emergencia WHERE trabajador_id = (SELECT id FROM datos_personales WHERE rut = ?)";
              $stmt_ce = $conn->prepare($sql_delete_ce);
              $stmt_ce->bind_param("s", $rut);
              $stmt_ce->execute();
              $stmt_ce->close();

              // Finalmente, eliminar de datos_personales
              $sql_delete_dp = "DELETE FROM datos_personales WHERE rut = ?";
              $stmt_dp = $conn->prepare($sql_delete_dp);
              $stmt_dp->bind_param("s", $rut);
              $stmt_dp->execute();
              $stmt_dp->close();

              // Confirmar la transacción
              $conn->commit();

              echo '<div class="alert alert-success" role="alert">El trabajador y sus datos relacionados han sido eliminados correctamente.</div>';

          } catch (Exception $e) {
              // Rollback en caso de error
              $conn->rollback();

              echo '<div class="alert alert-danger" role="alert">Error al intentar eliminar al trabajador y sus datos relacionados: ' . $e->getMessage() . '</div>';
          }
      }

      // Consulta SQL para obtener los datos de los trabajadores
      $sql_select = "SELECT dp.rut, dp.nombre, dp.genero, dl.cargo
                     FROM datos_personales dp
                     INNER JOIN datos_laborales dl ON dp.id = dl.trabajador_id";

      $result = $conn->query($sql_select); // Ejecuta la consulta

      // Verifica si se obtuvieron resultados
      if ($result->num_rows > 0) {
          // Itera sobre los resultados y muestra cada fila de la tabla
          while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . $row['rut'] . '</td>';
              echo '<td>' . $row['nombre'] . '</td>';
              echo '<td>' . $row['genero'] . '</td>';
              echo '<td>' . $row['cargo'] . '</td>';
              // Agrega los botones de eliminar y editar con formularios para enviar el ID del trabajador
              echo '<td>
                      <form action="' . $_SERVER["PHP_SELF"] . '" method="post" style="display:inline;">
                        <input type="hidden" name="rut" value="' . $row['rut'] . '">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                      </form>
                      <form action="editar_trabajador.php" method="get" style="display:inline;">
                        <input type="hidden" name="rut" value="' . $row['rut'] . '">
                        <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                      </form>
                    </td>';
              echo '</tr>';
          }
      } else {
          echo '<tr><td colspan="5">No se encontraron trabajadores.</td></tr>';
      }

      $conn->close(); // Cierra la conexión a la base de datos
      ?>
    </tbody>
  </table>
</div>
<div class="container mt-3">
  <a href="opciones.html" class="btn btn-secondary">Volver a Opciones</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
