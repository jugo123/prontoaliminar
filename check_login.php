<?php
include("conexion.php");

// Iniciar sesión
session_start();

$usuario = $_POST['correo'];
$clave = $_POST['password'];

// Sanitizar entradas
$usuario = $conn->real_escape_string($usuario);
$clave = $conn->real_escape_string($clave);

$query = "SELECT id, rut, contrasena, correo 
          FROM usuarios 
          WHERE correo = '$usuario' AND contrasena = '$clave';";

$resultado = mysqli_query($conn, $query);

// Verificar si retornó resultados
if (mysqli_num_rows($resultado) == 0) {
    header('Location: index.html');
    exit();
} else {
    // Retorna un arreglo asociativo (clave:valor) con los resultados de la query
    $fila = mysqli_fetch_assoc($resultado);

    // Crear variables de sesión
    $_SESSION['id'] = $fila["id"];
    $_SESSION['correo'] = $fila['correo'];
    $_SESSION['rut'] = $fila['rut'];
}

// Acceder a la variable de sesión para la segunda consulta
$id_trabajador = $_SESSION['id'];

$query2 = "SELECT id, trabajador_id, departamento
           FROM datos_laborales 
           WHERE trabajador_id = '$id_trabajador';";

$resultado2 = mysqli_query($conn, $query2);

if (mysqli_num_rows($resultado2) > 0) {
    while ($row = mysqli_fetch_assoc($resultado2)) {
        $departamento = $row["departamento"];
        if ($departamento == "HHRR") {
            include("opciones.html");
        
        }elseif($departamento == "admin") {
            include("admin.php");
        } else {
            header("Location: vista_trabajador.php");
            exit();
        }
    }
} else {
    header("Location: index.html");
    exit();
}
?>
