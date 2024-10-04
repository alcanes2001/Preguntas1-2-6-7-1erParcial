<?php
include '../../bd/conexion.php';

$id = $_GET['id'];

// Eliminar la propiedad asociada a la persona
$sql_propiedad = "DELETE FROM Propiedad WHERE id_persona=$id";
if ($conn->query($sql_propiedad) === TRUE) {
    // Luego eliminar la persona
    $sql_persona = "DELETE FROM Persona WHERE id=$id";
    if ($conn->query($sql_persona) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error al eliminar la persona: " . $conn->error;
    }
} else {
    echo "Error al eliminar la propiedad: " . $conn->error;
}
?>
