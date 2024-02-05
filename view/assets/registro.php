<?php
  session_start();
  require_once("../model/modelo_administrador.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
  <script src="js/bootstrap/bootstrap.min.js"></script>
  <!--end bootstrap -->
  <link rel="stylesheet" href="./css/style.css">
  <script src="js/index.js"></script>
  
  <title>Rutas Fucs | Registro</title>
</head>
<body>
  <header></header>
  <main>
    <section class="container mt-3 p-4 p-md-5 ">
      <h1 class="h1">Registro de usuario</h1>
      <hr>
      <form id="form" action="../controller/controlador_administrador.php" method="POST">
        <div class="form-group col-md-6">
          <label for="nombre">Nombre completo <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre completo" required>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="tipoDocumento">Tipo de identificación <span class="text-danger">*</span></label>
            <select id="tipoDocumento" name="tipoDocumento" class="form-select" required>
              <option value="Cédula de Ciudadania" selected>CC - Cédula de ciudadania</option>
              <option value="Tarjeta de Identidad">TI - Tarjeta de Identidad</option>
              <option value="Tarjeta Extranjería">TE - Tarjeta Extranjería</option>
              <option value="Cédula Extranjería">CE - Cédula Extranjería</option>
              <option value="Pasaporte">PAS - Pasaporte</option>
            </select> 
          </div>
          <div class="form-group col-md-6">
            <label for="documento">Número de identificación <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="documento" name="documento" placeholder="1234567" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="nombre">Tipo de usuario <span class="text-danger">*</span></label>
            <select class="form-select" name="tipoUsuario" id="tipoUsuario" required>
              <option value="">Seleccione una opción
                <?php 
                  $valore = new Consultas_admin();
                  $tipoFacul = $valore->verTipoLogin(1);
                  foreach ($tipoFacul as $rowUserLogin) {
                    echo"
                      <option value='".$rowUserLogin['id_tipo_login']."'> ".$rowUserLogin['nombre_tipo_login']."</option>
                    ";
                  }
                ?>
              </option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="nombre">Facultad a la que pertenece <span class="text-danger">*</span></label>
            <select class="form-select" name="facultad" id="facultad" required>
              <option value="">Seleccione una opción
                <?php 
                  $valore = new Consultas_admin();
                  $tipoFacul = $valore->verFacultad(1);
                  foreach ($tipoFacul as $rowFacul) {
                    echo"
                      <option value='".$rowFacul['nombre_facultad']."'> ".$rowFacul['nombre_facultad']."</option>
                    ";
                  }
                ?>
              </option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="correo">Correo Insitucional <span class="text-danger">*</span></label>
            <input class="form-control" id="correo" type="email" name="correo" required oninput="validarCorreo()">
            <div id="error-message" class="text-danger my-1 mx-2 error-message"></div>
          </div>
          <div class="form-group col-md-6">
            <label for="password">Contraseña <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary" name="registrar">Registrarse</button>
        <button type="button" class="btn btn-warning" onclick="goBack()">Atras</button>
      </form>
    </section>
  </main>
<?php include('footer.php') ?>