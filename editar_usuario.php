<?php

include 'caesera.php';
// Verificar si se ha proporcionado un ID de usuario en la URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Incluir el archivo de conexión
    include("conexion.php");
    
    // Obtener el ID del usuario de la URL
    $id = $_GET['id'];

    // Consultar los datos del usuario con el ID proporcionado
    $sql = "SELECT correo, contrasena FROM usuarios WHERE id = $id";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // Obtener los datos del usuario
        $usuario = $resultado->fetch_assoc();
        $correo = $usuario['correo'];
        $contrasena = $usuario['contrasena'];
    } else {
        // Si no se encuentra ningún usuario con el ID proporcionado, redirigir de vuelta a admin.php
        header("Location: admin.php");
        exit();
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se proporciona un ID de usuario en la URL, redirigir de vuelta a admin.php
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Editar Usuario</h2>
        <form action="actualizar_usuario.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo; ?>" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
