<?php
include 'caesera.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Usuarios</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    // Incluir el archivo de conexión
                    include("conexion.php");

                    // Consulta para obtener la lista de usuarios
                    $sql = "SELECT id, correo FROM usuarios";
                    $resultado = $conn->query($sql);

                    // Verificar si la consulta retornó resultados
                    if ($resultado->num_rows > 0) {
                        // Recorrer los resultados y mostrar cada usuario en una fila de la tabla
                        while ($row = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["correo"] . "</td>";
                            echo "<td><button class='btn btn-primary btnEditar' data-id='" . $row["id"] . "'>Editar</button></td>";
                            echo "<td><button class='btn btn-danger btnEliminar' data-id='" . $row["id"] . "'>Eliminar</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        // Si no hay usuarios, mostrar un mensaje
                        echo "<tr><td colspan='4'>No hay usuarios disponibles</td></tr>";
                    }

                    // Cerrar la conexión a la base de datos
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <a href="agregar_usuario.php" class="btn btn-primary mt-3">Agregar Usuario</a>
        </div>
    </div>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Manejar clics en botones de editar
        $(document).on('click', '.btnEditar', function() {
            var userId = $(this).data('id');
            // Redirigir a la página de edición de usuario con el ID del usuario como parámetro en la URL
            window.location.href = 'editar_usuario.php?id=' + userId;
        });

        // Manejar clics en botones de eliminar
        $(document).on('click', '.btnEliminar', function() {
            var userId = $(this).data('id');
            // Confirmar antes de eliminar el usuario
            if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
                // Enviar una solicitud AJAX para eliminar el usuario de la base de datos
                $.ajax({
                    url: 'eliminar_usuario.php',
                    method: 'POST',
                    data: { id: userId },
                    success: function(response) {
                        // Recargar la página después de eliminar el usuario
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error AJAX: ' + status + error);
                    }
                });
            }
        });
    </script>
</body>
</html>
