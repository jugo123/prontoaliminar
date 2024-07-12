<?php
session_start();

// Verificar las credenciales del trabajador (aquí se asume una validación básica)
if ($_POST['usuario'] === 'nombreusuario' && $_POST['contrasena'] === 'contraseña') {
    $_SESSION['usuario'] = $_POST['usuario'];
    header('Location: panel_trabajador.php'); // Redirigir al panel del trabajador
} else {
    echo 'Usuario o contraseña incorrectos.';
}
?>
