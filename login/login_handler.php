<?php
session_start();
include '../bd/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar si el usuario existe
    $sql = "SELECT * FROM Usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtenemos los datos del usuario
        $row = $result->fetch_assoc();

        // Verificamos la contraseña usando password_verify()
        if (md5($password) == $row['password']) {
            // Guardamos el tipo de usuario y el ID en la sesión
            $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
            $_SESSION['id'] = $row['id']; // Asegúrate de que el campo sea id_usuario en tu BD

            // Redirigimos según el tipo de usuario
            if ($row['tipo_usuario'] == 'funcionario') {
                header("Location: ../admin/index.php");  // Redirigir al dashboard del funcionario
            } elseif ($row['tipo_usuario'] == 'persona') {
                header("Location: ../index.php");  // Redirigir a la página de persona
            }
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>
