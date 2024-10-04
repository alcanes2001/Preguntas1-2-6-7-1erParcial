<?php
session_start();
include 'bd/conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Obtener el ID de la persona de la sesión
$id_persona = $_SESSION['id'];

// Consulta para obtener las propiedades del usuario
$sql = "SELECT direccion, tipo, codigo_catastral FROM Propiedad WHERE id_persona = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_persona);
$stmt->execute();
$result = $stmt->get_result();

// Comienzo del contenido HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Propiedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Mis Propiedades</h2><br>
    <a href="index.php" class="btn btn-primary">Volver</a><br><br>
    <?php
    // Mostrar propiedades
    if ($result->num_rows > 0) {
        echo "<table class='table table-striped table-bordered'>";
        echo "<thead class='table-dark'><tr><th>Dirección</th><th>Tipo</th><th>Codigo Catastral</th></tr></thead>";
        echo "<tbody>";

        // Recorrer los resultados y mostrarlos en una tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['direccion']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['codigo_catastral']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-warning'>No tienes propiedades registradas.</div>";
    }
    ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
