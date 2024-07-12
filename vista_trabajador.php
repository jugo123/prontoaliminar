<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.html');
    exit();
}
$id_trabajador = $_SESSION['id'];

include 'cabecera.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Trabajador</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Información del Trabajador</h2>
        <h3>Datos Personales</h3>
        <table class="table" id="table-personales">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Género</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <h3>Datos Laborales</h3>
        <table class="table" id="table-laborales">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cargo</th>
                    <th>Fecha de Ingreso</th>
                    <th>Área</th>
                    <th>Departamento</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <h3>Contactos de Emergencia</h3>
        <table class="table" id="table-contactos">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Relación</th>
                    <th>Teléfono</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <a href="agregar_contacto_emergencia.php?id_trabajador=<?php echo $_SESSION['id']; ?>" class="btn btn-primary">Agregar Nuevo Contacto de Emergencia</a>
        
        <!-- Aquí comienza la tabla de "cargas familiares" -->
        <h3>Cargas Familiares</h3>
        <table class="table" id="table-cargas">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Parentesco</th>
                    <th>Género</th>
                    <th>RUT</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se mostrarán las cargas familiares -->
            </tbody>
        </table>
        <!-- Aquí termina la tabla de "cargas familiares" -->
    </div>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: 'aiak_trabajo.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if(data.error) {
                        alert('Error: ' + data.error);
                        return;
                    }
                    
                    let personalesHtml = '';
                    let laboralesHtml = '';
                    $.each(data.personales, function(index, row) {
                        personalesHtml += `<tr>
                            <td>${row.nombre}</td>
                            <td>${row.genero}</td>
                            <td>${row.direccion}</td>
                            <td>${row.telefono}</td>
                            <td><a href="editar_datos_personales.php?id_trabajador=<?php echo $_SESSION['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a></td>
                        </tr>`;
                        laboralesHtml += `<tr>
                            <td>${row.nombre}</td>
                            <td>${row.cargo}</td>
                            <td>${row.fecha_ingreso}</td>
                            <td>${row.area}</td>
                            <td>${row.departamento}</td>
                        </tr>`;
                    });
                    $('#table-personales tbody').html(personalesHtml);
                    $('#table-laborales tbody').html(laboralesHtml);

                    let contactosHtml = '';
                    $.each(data.contactos, function(index, row_contactos) {
                        contactosHtml += `<tr>
                            <td>${row_contactos.nombre}</td>
                            <td>${row_contactos.relacion}</td>
                            <td>${row_contactos.telefono}</td>
                            <td><a href="editar_contacto_emergencia.php?id_contacto=${row_contactos.id}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a></td>
                            <td><a href="eliminar_contacto_emergencia.php?id_contacto=${row_contactos.id}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</a></td>
                        </tr>`;
                    });
                    $('#table-contactos tbody').html(contactosHtml);

                    // Agrega aquí el código para mostrar las cargas familiares
                    let cargasHtml = '';
                    $.each(data.cargas, function(index, row_cargas) {
                        cargasHtml += `<tr>
                            <td>${row_cargas.nombre}</td>
                            <td>${row_cargas.parentesco}</td>
                            <td>${row_cargas.genero}</td>
                            <td>${row_cargas.rut}</td>
                        </tr>`;
                    });
                    $('#table-cargas tbody').html(cargasHtml);
                },
                error: function(xhr, status, error) {
                    console.error('Error AJAX: ' + status + error);
                }
            });
        });
    </script>
</body>
</html>
