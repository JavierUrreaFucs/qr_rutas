<?php 
  
  session_start();
  require_once("../model/modelo_administrador.php");
  
  if (empty($_SESSION['correo'])) {
    session_destroy();
    header('location: login.php');
  } else if ( $_SESSION['id_tipo_login'] == 1 ) {
    include('navbar_admin.php');
  } else {
    include('navbar.php');
  }
?>
<main class="container-fluid perfil">
  <div class="col-12 py-5">
    <h1 class="h1">Perfil de usuario</h1>
    <hr>
    <div class="card m-auto" style="width: 22rem;">
      <img class="perfil p-2" src="../view/assets/img/LOGO-FUCS.png" class="card-img-top" alt="Logo fucs" width="80% !important">
      <div class="card-body">
        <h5 class="card-title text-center">Perfil</h5>
        <p class="card-text text-center"><?php echo $_SESSION['nombre_login'] ?></p>
      </div>
      <hr class="divider">
      <div class="card-body">
        <ul class="list-group list-group-flush d-flex bd-highlight text-center mx-auto " width="318px">
          <li class="list-group-item"><strong>Correo:</strong><br><?php echo $_SESSION['correo'] ?></li>
          <li class="list-group-item"><strong>número de identificación:</strong><br><?php echo $_SESSION['num_documento'] ?></li>
          <li class="list-group-item"><strong>Tipo de usuario:</strong><br><?php echo $_SESSION['nombre_tipo_login'] ?></li>
          <li class="list-group-item"><strong>Facultad a la que pertenece:</strong><br><?php echo $_SESSION['facultad_nombre'] ?></li>
        </ul>
      </div>
      <hr class="divider">
      <div class="card-body">
        <p class="card-text px-3"><i>Si desea actualizar sus datos debe comunicarse con el area administrativa.</i></p>
      </div>
    </div>
  </div>
  
</main>
<script>
  let titulo = document.title;
  document.title = "Rutas FUCS | Perfil";
</script>
<?php include('footer.php') ?>