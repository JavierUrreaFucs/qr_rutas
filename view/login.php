<?php
  session_start();
  if (isset($_SESSION['correo'])) {
    // El usuario ya ha iniciado sesión, redirige a la página principal u otra página
    header('Location: ../view/reservar.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <!-- bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
  <script src="js/bootstrap/bootstrap.min.js"></script>
  <!--end bootstrap -->
  <title>Rutas FUCS | Login</title>
</head>
<body>
<main>
  <div class="container-fluid fondo">
    <div class="row centro-login">
        <div class="col-md-6">
            <div class="card menu-login px-3">
                <div class="card-header">
                    <h4 class="text-center">Iniciar sesión</h4>
                </div>
                <div class="card-body">
                    <!-- Formulario de inicio de sesión -->
                    <form action="../controller/controlador_sesiones.php" method="POST">
                        <div class="form-group p-2">
                            <label for="user">Nombre de usuario:</label>
                            <input type="text" class="form-control" name="user" placeholder="Correo institucional" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña" required>
                        </div>
                        <div class="row">
                            <div class="col-6 p-2">
                                <button type="submit" name="acceder" class="btn btn-primary btn-block">Iniciar sesión</button>
                            </div>
                            <div class="col-6 p-2">
                                <a class="btn btn-primary" href="registro.php">Registrese</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<?php include('footer.php') ?>