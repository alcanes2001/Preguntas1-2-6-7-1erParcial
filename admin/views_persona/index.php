<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Registro de Persona</h2><br>
    <a href="../index.php" class="btn btn-info mb-3">Volver al Inicio</a>
    <form id="registro-persona" method="POST" action="guardar_persona.php">
        <!-- Campo de Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <!-- Campo de Apellido -->
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>

        <!-- Campo de CI -->
        <div class="mb-3">
            <label for="ci" class="form-label">CI</label>
            <input type="text" class="form-control" id="ci" name="ci" required>
        </div>

        <!-- Select de Distrito -->
        <div class="mb-3">
            <label for="distrito" class="form-label">Distrito</label>
            <select class="form-select" id="distrito" name="distrito" required>
                <option value="">Seleccione un distrito</option>
                <?php
                // Conexión a la base de datos
                include '../../bd/conexion.php';
                // Obtener distritos
                $sql = "SELECT id, nombre FROM Distritos";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Select de Zona -->
        <div class="mb-3">
            <label for="zona" class="form-label">Zona</label>
            <select class="form-select" id="zona" name="zona" required>
                <option value="">Seleccione una zona</option>
            </select>
        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Cuando se seleccione un distrito, se llama a la función para cargar las zonas
        $('#distrito').on('change', function() {
            var distritoId = $(this).val();
            if (distritoId) {
                $.ajax({
                    type: 'POST',
                    url: 'obtener_zona.php',  // Script que procesará la solicitud
                    data: {distrito_id: distritoId},
                    success: function(html) {
                        $('#zona').html(html);  // Actualizar las zonas en el combo
                    }
                });
            } else {
                $('#zona').html('<option value="">Seleccione una zona</option>');
            }
        });
    });

</script>
</body>
</html>
