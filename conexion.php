<?php
$servername = "localhost"; // Cambia según sea necesario
$username = "root"; // Cambia según sea necesario
$password = ""; // Cambia según sea necesario
$dbname = "empresa"; // Ca

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
