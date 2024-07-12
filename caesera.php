<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabecera</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <!-- Usar la variable de sesión directamente -->
                        <a class="nav-link" href="admin.php">Volver tabla usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
