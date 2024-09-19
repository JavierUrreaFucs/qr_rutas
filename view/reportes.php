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
  <section class="container mt-5 pt-5 my-5">
    <article>
      <div class="col-md-12">
        <h1 class="h1">Reportes</h1>
        <hr>
        <div class="py-3 p-md-3">
          <form method="POST" action="../controller/controlador_reportes.php">
            <div class="row">
              <div class="col-6 col-md-3 px-1">
                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
              </div>
              <div class="col-6 col-md-3 px-1">
                <label for="fecha_fin">Fecha de fin:</label>
                <input type="date" class="form-control" id="fecha_fin"  name="fecha_fin">
              </div>
              <div class="col-6 col-md-2 px-1">
                <label for="tipo_usuario">Usuario:</label>
                <select class="form-control" name="tipo_usuario">
                  <option value="">Todos</option>
                  <option value="Estudiante">Estudiante</option>
                  <option value="Docente">Docente</option>
                  <option value="Administrativo">Administrativo</option>
                </select>
              </div>
              <div class="col-6 col-md-2 px-1">
                <label for="fecha_fin">Horario:</label>
                <select class="form-control" id="filtro_hora" name="filtra_hora">
                  <option value="">Todo</option>
                  <option value="11:20 a.m">11:20 a.m.</option>
                  <option value="12:00 m">12:00 m.</option>
                  <option value="12:30 p.m">12:30 p.m.</option>
                  <option value="1:10 p.m">1:10 p.m.</option>
                </select>
              </div>
              <div class="col-6 col-md-2 px-1">
                <input type="submit" class="btn btn-outline-primary mt-4" name="reporte" value="Descargar Reporte">
              </div>
            </div>
          </form>
        </div>
      </div>
    </article>
  </section>
</main>
<script>
  let titulo = document.title;
  document.title = "Rutas FUCS | Reportes";
</script>