<?php
session_start();
include '../../bd/conexion.php';

// Comprobar si el usuario es funcionario
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'funcionario') {
    header("Location: login/login.php");
    exit();
}

$sql = "SELECT p.id, p.nombre, p.apellido, p.ci, pr.direccion, pr.tipo, pr.codigo_catastral
        FROM Persona p
        LEFT JOIN Propiedad pr ON p.id = pr.id_persona";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas y Propiedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Personas y Propiedades</h1><br>
        <a href="crear.php" class="btn btn-success mb-3">Registrar Propiedad</a>
        <a href="../index.php" class="btn btn-secondary mb-3">Volver al Inicio</a>
        <table class="table table-bordered">
            <thead class="table-info">
                <tr>
                    <th>ID Persona</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>CI</th>
                    <th>Dirección de la Propiedad</th>
                    <th>Tipo de Propiedad</th>
                    <th>Codigo Catastral</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['apellido']}</td>
                            <td>{$row['ci']}</td>
                            <td>{$row['direccion']}</td>
                            <td>{$row['tipo']}</td>
                            <td>{$row['codigo_catastral']}</td>
                            <td>
                                <a href='editar.php?id={$row['id']}' class='btn btn-primary'>Editar</a>
                                <a href='eliminar.php?id={$row['id']}' class='btn btn-danger'>Eliminar</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
