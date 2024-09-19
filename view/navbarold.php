<?php ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <!-- bootstrap -->
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <script src="js/bootstrap/bootstrap.min.js"></script>
  <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
  <!--end bootstrap -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <title id="title">Rutas FUCS | Navbar</title>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg color-nav">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img class="img-navbar" src="../view/assets/img/LOGO-FUCS-fondo-Azul-Fundadores.png" alt="Logonav fucs">
        </a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto mb-2 pe-5 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active text-white" aria-current="page" href="reservar.php">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Configuración
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                <li><a class="dropdown-item" href="password.php">Contraseña</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
