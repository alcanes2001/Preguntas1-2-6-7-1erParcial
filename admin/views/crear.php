<?php
session_start();
include '../../bd/conexion.php';

// Comprobar si el usuario es funcionario
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'funcionario') {
    header("Location: login/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $direccion = $_POST['direccion'];
    $tipo = $_POST['tipo'];
    $codigo = $_POST['codigo_catastral'];
    $id_persona = $_POST['id_persona'];

    // Insertar la nueva propiedad
    $sql = "INSERT INTO Propiedad (direccion, tipo, codigo_catastral, id_persona) VALUES ('$direccion', '$tipo', '$codigo','$id_persona')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error al registrar la propiedad: " . $conn->error;
    }
}

// Obtener la lista de personas para seleccionar
$sql_personas = "SELECT * FROM Persona";
$result_personas = $conn->query($sql_personas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Propiedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Registrar Propiedad</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Propiedad</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <div class="mb-3">
                <label for="codigo_catastral" class="form-label">Codigo Catastral</label>
                <input type="text" class="form-control" id="codigo_catastral" name="codigo_catastral" required>
            </div>

            <div class="mb-3">
                <label for="id_persona" class="form-label">Seleccionar Persona</label>
                <select class="form-select" id="id_persona" name="id_persona" required>
                    <option value="">Seleccione una persona</option>
                    <?php while ($row_persona = $result_personas->fetch_assoc()): ?>
                        <option value="<?php echo $row_persona['id']; ?>">
                            <?php echo $row_persona['nombre'] . " " . $row_persona['apellido']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>
</html>
