<?php 
  session_start();
  require_once('../model/modelo_administrador.php');

  if (empty($_SESSION['correo']) || $_SESSION['id_tipo_login'] != 1) {
    session_destroy();
    header('location: login.php');
  } else {
    include('navbar.php');
  }
?>
  <main>
    <section>
      <div class="container">
        <h1 class="h1">Registro de usuario</h1>
        <hr>
        <form id="form" action="../controller/controlador_administrador.php" method="POST">
          <div class="card p-3 card-registro">
            <div class="form-group p-2 col-md-6">
              <label for="nombre">Nombre completo <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre completo"
                required>
            </div>
            <div class="row">
              <div class="form-group p-2 col-md-6">
                <label for="tipoDocumento">Tipo de identificación <span class="text-danger">*</span></label>
                <select id="tipoDocumento" name="tipoDocumento" class="form-select" required>
                  <option value="Cédula de Ciudadania" selected>CC - Cédula de ciudadania</option>
                  <option value="Tarjeta de Identidad">TI - Tarjeta de Identidad</option>
                  <option value="Tarjeta Extranjería">TE - Tarjeta Extranjería</option>
                  <option value="Cédula Extranjería">CE - Cédula Extranjería</option>
                  <option value="Pasaporte">PAS - Pasaporte</option>
                </select>
              </div>
              <div class="form-group p-2 col-md-6">
                <label for="documento">Número de identificación <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="documento" name="documento" placeholder="1234567"
                  required>
              </div>
            </div>
            <div class="row">
              <div class="form-group p-2 col-md-6">
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
              <div class="form-group p-2 col-md-6">
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
              <div class="form-group p-2 col-md-6">
                <label for="correo">Correo Insitucional <span class="text-danger">*</span></label>
                <input class="form-control" id="correo" type="email" name="correo" required oninput="validarCorreo()">
                <div id="error-message" class="text-danger my-1 mx-2 error-message"></div>
              </div>
              <div class="form-group p-2 col-md-6">
                <label for="password">Contraseña <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 py-2">
                <button type="submit" class="btn btn-primary btncolor" name="registrar">Registrarse</button>
              </div>
              <div class="col-md-6 py-2">
                <button type="button" class="btn btn-warning botonamarillo" onclick="goBack()">Atras</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
  <?php include('footer.php') ?>