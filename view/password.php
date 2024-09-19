<?php
session_start();
require_once("../model/modelo_administrador.php");

if (empty($_SESSION['correo'])) {
  session_destroy();
  header('location: login.php');
} else if ($_SESSION['id_tipo_login'] == 1) {
  include('navbar_admin.php');
} else {
  include('navbar.php');
}

?>
<main>
  <section>
    <div class="container pt-5 mt-5">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card">
            <div class="card-title pt-3">
              <h2 class="text-center">Cambiar contraseña</h2>
            </div>
            <div class="card-body">
              <form action="../controller/controlador_administrador.php" method="POST">
                <div class="form-group"><label>Ingrese la contraseña Actual <b class="text-danger"> *</b></label> <input type="password" name="passactual" class="form-control" required></div>
                <div class="form-group py-2"><label>Ingrese la contraseña Nueva <b class="text-danger"> *</b></label> <input type="password" name="pass1" class="form-control" required></div>
                <div class="form-group pb-2"><label>Vuelva a escribir la nueva contraseña <b class="text-danger"> *</b></label> <input type="password" name="pass2" class="form-control" required></div>
                <div class="py-2">
                  <input type="hidden" name="id_login" value="<?php echo $_SESSION['id_login']; ?>">
                  <button class="btn btn-outline-primary" name="cambiar_pass" type="submit"><strong>Cambiar Contraseña</strong></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>