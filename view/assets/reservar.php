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

include('ver_rutas.php');
?>
<main>
  <!-- Formulario de registro-->
  <section class="container p-3 p-md-5 p-lg-5">
    <h1 class="h1">Generar reserva</h1>
    <hr>
    <form id="form" action="../controller/controlador_administrador.php" method="POST">
      <div class="form-group col-md-6">
        <label>Nombre completo <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="nombre" readonly
          value="<?php echo $_SESSION['nombre_login'] ?>">
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="documento">Número de identificación <span class="text-danger">*</span></label>
          <input type="number" class="form-control" name="documento" readonly
            value="<?php echo $_SESSION['num_documento'] ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="facultad">Tipo de usuario <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="tipoUsuario" readonly
            value="<?php echo $_SESSION['nombre_tipo_login'] ?>">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="correo">Correo Insitucional <span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="correo" value="<?php echo $_SESSION['correo'] ?>" 
            readonly>
        </div>
        <div class="form-group col-md-6">
          <label for="facultad">Facultad a la que pertenece <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="facultad" readonly
            value="<?php echo $_SESSION['facultad_nombre'] ?>">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="correo">Selecione la ruta de destino <span class="text-danger">*</span></label>
          <select class="form-select" name="destino" required>
            <option value="" selected>Selecione una opción</option>
            <option value="Sede centro - Sede norte">Sede centro - Sede norte</option>
            <option value="Sede norte - Sede centro">Sede norte - Sede centro</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="horario">Horario <span class="text-danger">*</span></label>
          <select class="form-select" name="horario" required>
            <option value="">Selecione una opción</option>
            <?php
            $valorRuta = new Consultas_admin();
            $destinoRuta = $valorRuta->verRutas(1);
            foreach ($destinoRuta as $rowRuta) {
              echo "<option value='" . $rowRuta['id_rutas'] . "'>" . $rowRuta['horario'] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group col-md-6">
          <input type="hidden" class="form-control" name="idLogin" value="<?php echo $_SESSION['id_login'] ?> " readonly>
          <input type="hidden" class="form-control" name="idTipoLogin" value="<?php echo $_SESSION['id_tipo_login'] ?>" readonly>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="reservar">Reservar</button>
    </form>
  </section>
</main>
<script>
  let titulo = document.title;
  document.title = "Rutas FUCS | Reservar";
</script>
<?php include('footer.php') ?>