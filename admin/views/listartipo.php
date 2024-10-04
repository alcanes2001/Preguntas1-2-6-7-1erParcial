<?php
session_start();
include '../../bd/conexion.php';

// Comprobar si el usuario es funcionario
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'funcionario') {
    header("Location: login.php");
    exit();
}

// Consulta SQL para obtener los datos
$sql = "SELECT p.id, p.nombre, p.apellido, p.ci, pr.direccion, pr.tipo, pr.codigo_catastral
        FROM Persona p
        LEFT JOIN Propiedad pr ON p.id = pr.id_persona
        ORDER BY 
            CASE 
                WHEN pr.codigo_catastral LIKE '1%' THEN 1
                WHEN pr.codigo_catastral LIKE '2%' THEN 2
                WHEN pr.codigo_catastral LIKE '3%' THEN 3
                ELSE 4  
            END";

$result = $conn->query($sql);

// Crear arreglos vacíos para almacenar los datos por código catastral
$codigo_1 = [];
$codigo_2 = [];
$codigo_3 = [];

// Iterar sobre los resultados y llenar los arreglos
while ($row = $result->fetch_assoc()) {
    if (strpos($row['codigo_catastral'], '1') === 0) {
        $codigo_1[] = $row;
    } elseif (strpos($row['codigo_catastral'], '2') === 0) {
        $codigo_2[] = $row;
    } elseif (strpos($row['codigo_catastral'], '3') === 0) {
        $codigo_3[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas y Propiedades (Pivot)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Listado de Personas y Propiedades Ordenado Por Tipo de Impuesto</h1>
        <h5>Ordenado por Tipo de Impuesto</h5><br>
        <a href="../index.php" class="btn btn-info mb-3">Volver al Inicio</a>
        
        <table class="table table-bordered">
            <thead class="table-info">
                <tr>
                    <th>Información</th>
                    <th>Impuesto Alto (1)</th>
                    <th>Impuesto Medio (2)</th>
                    <th>Impuesto Bajo (3)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Código Catastral</td>
                    <td>
                        <?php foreach ($codigo_1 as $prop) { echo $prop['codigo_catastral'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_2 as $prop) { echo $prop['codigo_catastral'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_3 as $prop) { echo $prop['codigo_catastral'] . '<br>'; } ?>
                    </td>
                </tr>
                <!-- Mostrar los nombres -->
                <tr>
                    <td>Nombre</td>
                    <td>
                        <?php foreach ($codigo_1 as $prop) { echo $prop['nombre'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_2 as $prop) { echo $prop['nombre'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_3 as $prop) { echo $prop['nombre'] . '<br>'; } ?>
                    </td>
                </tr>

                <!-- Mostrar los apellidos -->
                <tr>
                    <td>Apellido</td>
                    <td>
                        <?php foreach ($codigo_1 as $prop) { echo $prop['apellido'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_2 as $prop) { echo $prop['apellido'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_3 as $prop) { echo $prop['apellido'] . '<br>'; } ?>
                    </td>
                </tr>

                <!-- Mostrar los CIs -->
                <tr>
                    <td>CI</td>
                    <td>
                        <?php foreach ($codigo_1 as $prop) { echo $prop['ci'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_2 as $prop) { echo $prop['ci'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_3 as $prop) { echo $prop['ci'] . '<br>'; } ?>
                    </td>
                </tr>

                <!-- Mostrar las direcciones -->
                <tr>
                    <td>Dirección</td>
                    <td>
                        <?php foreach ($codigo_1 as $prop) { echo $prop['direccion'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_2 as $prop) { echo $prop['direccion'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_3 as $prop) { echo $prop['direccion'] . '<br>'; } ?>
                    </td>
                </tr>

                <!-- Mostrar los tipos de propiedad -->
                <tr>
                    <td>Tipo de Propiedad</td>
                    <td>
                        <?php foreach ($codigo_1 as $prop) { echo $prop['tipo'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_2 as $prop) { echo $prop['tipo'] . '<br>'; } ?>
                    </td>
                    <td>
                        <?php foreach ($codigo_3 as $prop) { echo $prop['tipo'] . '<br>'; } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
