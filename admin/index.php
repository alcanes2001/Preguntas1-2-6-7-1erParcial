<?php
session_start();
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'funcionario') {
    header("Location: ../login/login.php");  // Redirigir si no es funcionario
    exit();
}
?>
<?php include('templates/cabecera.php') ?>
    <main>
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Bienvenido al Dashboard del Funcionario</h1>
                <p class="col-md-8 fs-4">
                    En esta sección el funcionario puede gestionar la información del catastro.
                </p><br>
                <a href="../logout/logout.php" class="btn btn-danger btn-lg">Cerrar Sesión</a>
            </div>
        </div>
        
    </main>

<?php include('templates/pie.php') ?>    