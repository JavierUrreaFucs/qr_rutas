<?php
  session_start();
  if (isset($_SESSION['correo'])) {
    // El usuario ya ha iniciado sesión, redirige a la página principal u otra página
    header('Location: ../view/reservar.php');
    exit();
  }
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <title>Rutas FUCS | Recuperar contraseña</title>
  <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <main>
    <div class="container mt-5 text-center">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card">
            <div class="p-2">
              <img class="card-img-top img-pass" src="assets/img/LOGO-FUCS.png">
            </div>
            <div class="card-body">
              <h4 class="h4 py-3">Recuperación de contraseña</h4>
              <form class="m-t p-2" role="form" action="../controller/controlador_sesiones.php" method="POST">
                <div class="form-group py-2">
                  <input type="email" name="correo1" class="form-control p-2" placeholder="Correo electrónico" required="">
                </div>
                <div class="form-group py-2">
                  <input type="email" name="correo2" class="form-control p-2" placeholder="Vuelve a escribir el correo electrónico" required="">
                </div>
                <div class="row pt-2">
                  <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-primary py-2" name="recuperarcontrasenia">Recuperar</button>
                  </div>
                  <div class="d-grid gap-2 col-6 mx-auto">
                    <a type="button" class="btn btn-warning" href="login.php">Atrás</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include('footer.php'); ?>