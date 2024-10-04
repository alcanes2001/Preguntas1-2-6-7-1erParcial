<?php
session_start();
include '../../bd/conexion.php';

// Comprobar si el usuario es funcionario
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'funcionario') {
    header("Location: login/login.php");
    exit();
}

// Comprobar si se ha proporcionado un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos de la persona y la propiedad
    $sql = "SELECT p.id, p.nombre, p.apellido, p.ci, pr.direccion, pr.tipo, pr.codigo_catastral, pr.id AS id_propiedad
            FROM Persona p
            LEFT JOIN Propiedad pr ON p.id = pr.id_persona
            WHERE p.id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $ci = $row['ci'];
        $direccion = $row['direccion'];
        $tipo_propiedad = $row['tipo'];
        $codigo = $row['codigo_catastral'];
        $id_propiedad = $row['id_propiedad'];
    } else {
        echo "Persona no encontrada";
        exit();
    }
} else {
    echo "ID no proporcionado";
    exit();
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['ci'];
    $direccion = $_POST['direccion'];
    $tipo_propiedad = $_POST['tipo'];
    $codigo = $_POST['codigo_catastral'];

    // Actualizar los datos de la persona
    $sql_update_persona = "UPDATE Persona SET nombre='$nombre', apellido='$apellido', ci='$ci' WHERE id=$id";

    if ($conn->query($sql_update_persona) === TRUE) {
        // Si tiene una propiedad asociada, actualizamos la propiedad
        if (!empty($id_propiedad)) {
            $sql_update_propiedad = "UPDATE Propiedad SET direccion='$direccion', tipo='$tipo_propiedad', codigo_catastral='$codigo'  WHERE id=$id_propiedad";
            if ($conn->query($sql_update_propiedad) === TRUE) {
                header("Location: index.php");
            } else {
                echo "Error al actualizar la propiedad: " . $conn->error;
            }
        } else {
            // Si no tiene propiedad, insertar una nueva
            $sql_insert_propiedad = "INSERT INTO Propiedad (direccion, tipo, codigo_catastral, id_persona) VALUES ('$direccion', '$tipo_propiedad', '$codigo' ,'$id')";
            if ($conn->query($sql_insert_propiedad) === TRUE) {
                header("Location: index.php");
            } else {
                echo "Error al insertar nueva propiedad: " . $conn->error;
            }
        }
    } else {
        echo "Error al actualizar la persona: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona y Propiedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Persona y Propiedad</h1>
        <form method="POST" action="">
            <!-- Sección de edición de la Persona -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ci" class="form-label">CI</label>
                <input type="text" class="form-control" id="ci" name="ci" value="<?php echo $ci; ?>" required>
            </div>

            <!-- Sección de edición de la Propiedad -->
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección de la Propiedad</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>">
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Propiedad</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $tipo_propiedad; ?>">
            </div>
            <div class="mb-3">
                <label for="codigo_catastral" class="form-label">Codigo Catastral</label>
                <input type="text" class="form-control" id="codigo_catastral" name="codigo_catastral" value="<?php echo $codigo; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>