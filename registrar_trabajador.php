<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Trabajadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-10">
                    <div class="card-body">
                        <h5 class="card-title">Registro de Trabajadores</h5>
                        <hr>
                        <form id="formulario" method="POST" onsubmit="return enviarFormulario();">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label" for="nombre">Nombre Completo:</label>
                                    <input class="form-control obligatorio" type="text" name="nombre" id="nombre" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="run">RUN:</label>
                                <input class="form-control obligatorio rutsit-o" type="text" name="run" id="run" onblur="validarRut(this.value)" >
                            </div>
                            <div class="form-group">
                                <label for="genero">Género:</label>
                                <select class="form-control" id="genero" name="genero" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="direccion">Dirección:</label>
                                <input class="form-control obligatorio" type="text" name="direccion" id="direccion">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="cargo">Cargo:</label>
                                <input class="form-control obligatorio" type="text" name="cargo" id="cargo">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="area">Área:</label>
                                <input class="form-control obligatorio" type="text" name="area" id="area">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="departamento">Departamento:</label>
                                <input class="form-control obligatorio" type="text" name="departamento" id="departamento">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="telefono">Teléfono:</label>
                                <input class="form-control obligatorio solo-numeros" type="text" name="telefono" id="telefono">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="ingreso">Fecha de ingreso:</label>
                                <input class="form-control obligatorio" type="date" name="fechaIngreso" id="ingreso">
                            </div>                            
                            <hr>
                            <h5 class="card-subtitle">Contacto de emergencias</h5>
                            <div class="mb-3">
                                <label class="form-label" for="nombre_contacto">Nombre del contacto de emergencias:</label>
                                <input class="form-control obligatorio" type="text" name="contactoEmergencia" id="nombre_contacto">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="parentesco_contacto">Parentesco del contacto de emergencias:</label>
                                <input class="form-control obligatorio" type="text" name="relacion" id="parentesco_contacto">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="numero_contacto">Número de teléfono del contacto de emergencia:</label>
                                <input class="form-control obligatorio solo-numeros" type="text" name="telefonoEmergencia" id="numero_contacto">
                            </div>
                            <hr>
                            <h5 class="card-subtitle">Carga familiar</h5>
                            <div class="mb-3">
                                <label class="form-label" for="nombre_carga">Nombre:</label>
                                <input class="form-control obligatorio" type="text" name="nombreFamiliar" id="nombre_carga">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="parentesco_carga">Parentesco:</label>
                                <input class="form-control obligatorio" type="text" name="parentesco" id="parentesco_carga">
                            </div>
                            <div class="form-group">
                                <label for="genero_carga">Género:</label>
                                <select class="form-control" id="genero_carga" name="genero_carga" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="run_carga">RUT:</label>
                                <input class="form-control obligatorio rutsit-o" type="text" name="rutFamiliar" id="run_carga">
                            </div>
                            <div class="d-flex align-items-end justify-content-center">
                                <button type="submit" class="btn btn-success" id="btnAgregar">Agregar </button>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <a href="opciones.html" class="btn btn-secondary">Volver a Opciones</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script src="js/jsHR.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function enviarFormulario() {
            // Deshabilitar el botón de envío para evitar envíos múltiples
            document.getElementById('btnAgregar').disabled = true;
            return true; // Envía el formulario
        }
    </script>
</body>
</html>
<?php
include 'conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $rut = $_POST['run'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $fechaIngreso = $_POST['fechaIngreso'] ?? '';
    $area = $_POST['area'] ?? '';
    $departamento = $_POST['departamento'] ?? '';
    $contactoEmergencia = $_POST['contactoEmergencia'] ?? '';
    $relacion = $_POST['relacion'] ?? '';
    $telefonoEmergencia = $_POST['telefonoEmergencia'] ?? '';
    $nombreFamiliar = $_POST['nombreFamiliar'] ?? '';
    $parentesco = $_POST['parentesco'] ?? '';
    $generoFamiliar = $_POST['genero_carga'] ?? '';
    $rutFamiliar = $_POST['rutFamiliar'] ?? '';

    // Verificar si los datos obligatorios no están vacíos
    if (!empty($nombre) && !empty($rut) && !empty($genero) && !empty($direccion) && !empty($telefono) &&
        !empty($cargo) && !empty($fechaIngreso) && !empty($area) && !empty($departamento) &&
        !empty($contactoEmergencia) && !empty($relacion) && !empty($telefonoEmergencia) &&
        !empty($nombreFamiliar) && !empty($parentesco) && !empty($generoFamiliar) && !empty($rutFamiliar)) {
        
        // Iniciar transacción
        $conn->begin_transaction();

        try {
            // Insertar datos personales
            $sql = "INSERT INTO datos_personales (nombre, rut, genero, direccion, telefono)
                    VALUES ('$nombre', '$rut', '$genero', '$direccion', '$telefono')";
            $conn->query($sql);

            // Obtener el ID del trabajador insertado
            $trabajador_id = $conn->insert_id;

            // Insertar datos laborales
            $sql = "INSERT INTO datos_laborales (trabajador_id, cargo, fecha_ingreso, area, departamento)
                    VALUES ('$trabajador_id', '$cargo', '$fechaIngreso', '$area', '$departamento')";
            $conn->query($sql);

            // Insertar contacto de emergencia
            $sql = "INSERT INTO contactos_emergencia (trabajador_id, nombre, relacion, telefono)
                    VALUES ('$trabajador_id', '$contactoEmergencia', '$relacion', '$telefonoEmergencia')";
            $conn->query($sql);

            // Insertar carga familiar
            $sql = "INSERT INTO cargas_familiares (trabajador_id, nombre, parentesco, genero, rut)
                    VALUES ('$trabajador_id', '$nombreFamiliar', '$parentesco', '$generoFamiliar', '$rutFamiliar')";
            $conn->query($sql);

            // Commit si todas las inserciones son exitosas
            $conn->commit();
            echo "Ficha de trabajador guardada exitosamente.";
        } catch (Exception $e) {
            // Rollback en caso de error
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Por favor, complete todos los campos obligatorios.";
    }

    $conn->close();
}
?>


</body>
</html>
