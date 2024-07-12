<?php
session_start();

// Verificar si el trabajador está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: inicio_sesion.php'); // Redirigir al inicio de sesión si no está autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel del Trabajador</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h1 class="text-center mb-4">Panel del Trabajador</h1>
    <!-- Aquí agregar formularios o secciones para modificar datos personales, cargas familiares y contactos de emergencia -->
    <form action="procesar_modificacion.php" method="POST">
      <!-- Campos para modificar datos personales, cargas familiares y contactos de emergencia -->
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
    <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
  </div>
</body>
</html>
