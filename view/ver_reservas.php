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
    <div class="container my-5 pt-5">
      <h1 class="h1 pt-1">Reservas Realizadas</h1>
      <hr>
      <div class="py-3 p-md-3">
        <form method="POST" action="">
          <div class="row">
            <div class="col-6 col-md-4 px-1">
              <label for="fecha_inicio">Fecha de inicio:</label>
              <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
            </div>
            <div class="col-6 col-md-4 px-1">
              <label for="fecha_fin">Fecha de fin:</label>
              <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
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
              <input type="submit" class="btn btn-outline-primary mt-4" name="filtra-reserva" value="Filtrar">
            </div>
          </div>
        </form>
      </div>
      <div class="container">
        <div class="table-responsive">
          <table class="table table-bordered px-2" id="myTable">
            <thead>
              <tr>
                <th class="th-font table-secondary">ID</th>
                <th class="th-font table-secondary">Nombre completo</th>
                <th class="th-font table-secondary">N° Documento</th>
                <th class="th-font table-secondary">Correo electrónico</th>
                <th class="th-font table-secondary">Fecha Solicitud</th>
                <th class="th-font table-secondary">Tipo de usuario</th>
                <th class="th-font table-secondary">Facultad</th>
                <th class="th-font table-secondary">Destino</th>
                <th class="th-font table-secondary">Hora</th>
                <th class="th-font table-secondary">valor a pagar</th>
                <th class="th-font table-secondary">Estado</th>
                <th class="th-font table-secondary">Ubicación</th>
                <th class="th-font table-secondary">Documento a presentar</th>
                <th class="th-font table-secondary">Administrar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // filtrar tabla por fechas de reservas
              $vistaUsuario = new Consultas_admin();
              $resReserva = $vistaUsuario->verReservas(1);
              // Verificar si se enviaron fechas desde el formulario
              if (isset($_POST["filtra-reserva"])) {
                $fechaInicio = $_POST['fecha_inicio'];
                $fechaFin = $_POST['fecha_fin'];
                $horarioFiltro = $_POST['filtra_hora'];
                if ((!empty($fechaInicio) && !empty($fechaFin)) || (!empty($horarioFiltro))) {
                  $resReserva = $vistaUsuario->verReservasFiltradas($fechaInicio, $fechaFin, $horarioFiltro);
                } else {
                  // Si no se enviaron fechas, mostrar todas las reservas
                  $resReserva = $vistaUsuario->verReservas(1);
                }
              }

              foreach ($resReserva as $rowReserva) {
              ?>
                <tr>
                  <td class="th-font"><?php echo $rowReserva['id_reserva'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['nombre_usuario'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['cedula_reserva'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['correo_reserva'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['fecha_solicitud'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['tipo_login_nombre'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['nombre_facultad'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['destino_ruta'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['horario_ruta'] ?></td>
                  <td class="th-font">$ <?php echo $rowReserva['valor_pagar'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['reserva_pago'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['ubicacion_recogida'] ?></td>
                  <td class="th-font"><?php echo $rowReserva['presentar'] ?></td>
                  <td class="th-font">
                    <?php
                    // Se valida si el estudiante aun no ha pagado
                    if ($rowReserva['reserva_pago'] == 'Pendiente pago') {
                    ?>
                      <a class="dropdown">
                        <a class="dropdown-toggle btn btn-outline-success btn-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Accion
                        </a>
                        <ul class="dropdown-menu menu-bg">
                          <li class="dropdown-item">
                            <form action="../controller/controlador_administrador.php" method="POST" class="cashForm">
                              <input type="hidden" name="id_reserva" value="<?php echo $rowReserva['id_reserva'] ?>">
                              <input type="hidden" name="cedula_reserva" value="<?php echo $rowReserva['cedula_reserva'] ?>">
                              <input type="hidden" name="rutas_id_rutas" value="<?php echo $rowReserva['rutas_id_rutas'] ?>">
                              <button type="submit" class="btn btn-dropdown dropdown-item white-bg text-success" name="pagar_reserva"><i class="bi bi-cash-stack"></i> Pagar</button>
                            </form>
                          </li>
                          <li class="dropdown-item">
                            <form action="../controller/controlador_administrador.php" method="POST" class="deleteForm">
                              <input type="hidden" name="id_reserva" value="<?php echo $rowReserva['id_reserva'] ?>">
                              <input type="hidden" name="cedula_reserva" value="<?php echo $rowReserva['cedula_reserva'] ?>">
                              <input type="hidden" name="rutas_id_rutas" value="<?php echo $rowReserva['rutas_id_rutas'] ?>">
                              <button type="submit" class="btn btn-dropdown dropdown-item white-bg text-danger" name="eliminar_reserva"><i class="bi bi-trash3-fill"></i> Eliminar</button>
                            </form>
                          </li>
                        </ul>
                      </a>
                    <?php } else { ?>
                      <div class="form-group">
                      <form action="../controller/controlador_administrador.php" method="POST" class="deleteForm">
                              <input type="hidden" name="id_reserva" value="<?php echo $rowReserva['id_reserva'] ?>">
                              <input type="hidden" name="cedula_reserva" value="<?php echo $rowReserva['cedula_reserva'] ?>">
                              <input type="hidden" name="rutas_id_rutas" value="<?php echo $rowReserva['rutas_id_rutas'] ?>">
                              <button type="submit" class="btn btn-outline-danger btn-sm" name="eliminar_reserva"><i class="bi bi-trash3-fill"></i> Eliminar</button>
                            </form>
                      </div>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- JavaScript -->
<script>
  let titulo = document.title;
  document.title = "Rutas FUCS | Reservas";
</script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>
<script src="./js/dataTables.js"></script>
<?php include('footer.php') ?>