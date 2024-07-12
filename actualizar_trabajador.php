<?php
include 'conexion.php'; // Incluir el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $rut = $_POST['editRut'];
  $nombre = $_POST['editNombre'];
  $genero = $_POST['editGenero'];
  $cargo = $_POST['editCargo'];
  $area = $_POST['editArea'];
  $departamento = $_POST['editDepartamento'];

  // Actualizar los datos en la base de datos
  $sql = "UPDATE datos_personales dp
          INNER JOIN datos_laborales dl ON dp.id = dl.trabajador_id
          SET dp.nombre = ?, dp.genero = ?, dl.cargo = ?, dl.area = ?, dl.departamento = ?
          WHERE dp.rut = ?";

  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssssss", $nombre, $genero, $cargo, $area, $departamento, $rut);

    if ($stmt->execute()) {
      echo "Datos actualizados correctamente.";
    } else {
      echo "Error al actualizar los datos: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "Error al preparar la consulta: " . $conn->error;
  }

  $conn->close();
}
?>
