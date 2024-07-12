<?php
session_start();

// Verificar si el trabajador está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: inicio_sesion.php'); // Redirigir al inicio de sesión si no está autenticado
    exit();
}

// Procesar la modificación de datos (aquí se asume la lógica de actualización en la base de datos)
// Implementa lógica para agregar/eliminar cargas familiares, contactos de emergencia y modificar datos personales

// Redirigir al panel del trabajador después de procesar la modificación
header('Location: panel_trabajador.php');
?>
