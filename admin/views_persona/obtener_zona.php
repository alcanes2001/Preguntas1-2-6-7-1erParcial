<?php
include '../../bd/conexion.php';

if (isset($_POST['distrito_id'])) {
    $distrito_id = $_POST['distrito_id'];

    // Consulta para obtener las zonas correspondientes al distrito seleccionado
    $sql = "SELECT id, nombre FROM Zonas WHERE distrito_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $distrito_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generar las opciones HTML para las zonas
    if ($result->num_rows > 0) {
        echo '<option value="">Seleccione una zona</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
        }
    } else {
        echo '<option value="">No hay zonas disponibles</option>';
    }
}
?>
