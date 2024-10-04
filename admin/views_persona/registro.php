<?php
include '../../bd/conexion.php'; // Asegúrate de que la conexión está bien configurada

// Consulta para obtener todas las personas
$sql = "SELECT p.nombre, p.apellido, p.ci, d.nombre AS distrito, z.nombre AS zona 
        FROM Persona p
        JOIN Distritos d ON p.distrito_id = d.id
        JOIN Zonas z ON p.zona_id = z.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Personas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Listado de Personas</h2>
        <a href="../index.php" class="btn btn-info mb-3">Volver al Inicio</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>CI</th>
                    <th>Distrito</th>
                    <th>Zona</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Mostrar cada persona en una fila
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['apellido'] . "</td>";
                        echo "<td>" . $row['ci'] . "</td>";
                        echo "<td>" . $row['distrito'] . "</td>";
                        echo "<td>" . $row['zona'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay personas registradas</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
