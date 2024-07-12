<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST['rut'];
    $contrasena = $_POST['contrasena'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "empresa";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $query = "SELECT * FROM usuarios WHERE rut = '$rut' AND contrasena = '$contrasena'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $_SESSION['rut'] = $rut;
        header("Location: trabajadordatos.php");
        exit();
    } else {
        $error = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - Trabajador</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h1 class="text-center mb-4">Iniciar Sesión - Trabajador</h1>
  <form method="POST">
    <div class="form-group">
      <label for="rut">RUT:</label>
      <input type="text" class="form-control" id="rut" name="rut" required>
    </div>
    <div class="form-group">
      <label for="contrasena">Contraseña:</label>
      <input type="password" class="form-control" id="contrasena" name="contrasena" required>
    </div>
    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    <?php if (isset($error)) { ?>
        <div class="text-danger mt-2"><?php echo $error; ?></div>
    <?php } ?>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
