<?php
include '../../bd/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['ci'];
    $distrito_id = $_POST['distrito'];
    $zona_id = $_POST['zona'];

    // Verificar que todos los datos están presentes
    if (!empty($nombre) && !empty($apellido) && !empty($ci) && !empty($distrito_id) && !empty($zona_id)) {
        
        // Insertar los datos de la persona en la base de datos
        $sql = "INSERT INTO Persona (nombre, apellido, ci, distrito_id, zona_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        // Asignar los valores a los parámetros
        $stmt->bind_param("sssii", $nombre, $apellido, $ci, $distrito_id, $zona_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            header("Location: registro.php");
        } else {
            echo "Error al guardar la persona: " . $stmt->error;
        }

        $stmt->close();

    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>

