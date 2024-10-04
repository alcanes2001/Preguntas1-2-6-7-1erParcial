<?php
session_start();
include 'bd/conexion.php';

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'persona') {
    header("Location: login/login.php");  // Redirigir si no es persona
    exit();
}

$sql = "SELECT p.id, p.nombre, p.apellido, p.ci, pr.direccion, pr.tipo
        FROM Persona p
        LEFT JOIN Propiedad pr ON p.id = pr.id_persona";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Catastro HAM-LP</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+591 60630730</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>alcanes2001@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.php" class="navbar-brand ml-lg-3">
                <div class="logo-gamlp">
                    <img width="100px" src="https://sitservicios.lapaz.bo/sit/catastro/images/HEADER_ACM-1.png" alt="" srcset="">
                </div>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Inicio</a>
                    <a href="propiedad.php" class="nav-item nav-link">Tramites</a>
                    <a href="#" class="nav-item nav-link">Normativa</a>
                    <a href="#" class="nav-item nav-link">Ficha Catastral</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Herramientas</a>
                        <div class="dropdown-menu m-0">
                            <a href="#" class="dropdown-item">Formulario Digital de Catastro</a>
                            <a href="#" class="dropdown-item">Cartilla de Catastro</a>
                            <a href="#0" class="dropdown-item">Catastro</a>
                        </div>
                    </div>
                </div>
                <a href="logout/logout.php" class="btn btn-primary py-2 px-4 d-none d-lg-block">Cerrar Sesión</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h1 class="text-white mt-4 mb-4">Municipio de La Paz</h1>
            <h1 class="text-white display-1 mb-5">Catastro HAM-LP</h1>
            <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Buscar por Codigo Catastral: </button>
                    </div>
                    <input type="number" class="form-control border-light" id="id_persona" name="id_persona" style="padding: 30px 25px;" placeholder="Codigo Catastral">
                    <div class="input-group-append">
                        <a href="propiedad.php" class="btn btn-secondary">Buscar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-image" style="margin: 90px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 my-5 pt-5 pb-lg-5">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Catastro HAM-LP </h6>
                        <h1 class="display-4">Bienvenido al Área de Catastro de la HAM-LP</h1>
                    </div>
                    <p class="mb-4 pb-2">
                        En este sistema podrás gestionar y consultar tus propiedades registradas en el área de Catastro de la Honorable Alcaldía Municipal de La Paz (HAM-LP).
                        </p>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/Cartilla-Catastro.jpg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Feature Start -->


    <!-- Courses Start -->
    <div class="container-fluid px-0 py-5">
        <div class="row mx-0 justify-content-center pt-5">
            <div class="col-lg-6">
                <div class="section-title text-center position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Tramites</h6>
                    <h1 class="display-4">Tramites</h1>
                </div>
            </div>
        </div>
        <div class="owl-carousel courses-carousel">
            <div class="courses-item position-relative">
                <img class="img-fluid" src="img/Cartilla-Catastro.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">Tipos de Tramites</h4>
                    
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="#">Entrar</a>
                    </div>
                </div>
            </div>
            <div class="courses-item position-relative">
                <img class="img-fluid" src="img/Cartilla-Catastro.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">Registro de Propiedades</h4>
                    
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="#">Entrar</a>
                    </div>
                </div>
            </div>
            <div class="courses-item position-relative">
                <img class="img-fluid" src="img/Cartilla-Catastro.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">Consulta de Propiedades</h4>
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="#">Entrar</a>
                    </div>
                </div>
            </div>
            <div class="courses-item position-relative">
                <img class="img-fluid" src="img/Cartilla-Catastro.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">Actualización de Propiedades</h4>
    
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="#">Entrar</a>
                    </div>
                </div>
            </div>
            <div class="courses-item position-relative">
                <img class="img-fluid" src="img/Cartilla-Catastro.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">Transferencia de Propiedades</h4>
                    <div class="w-100 bg-white text-center p-4" >
                        <a class="btn btn-primary" href="#">Entrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 border-top py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0">Copyright &copy; <a class="text-white" href="#"><a>2024 Área de Catastro - HAM-LP</a>. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>