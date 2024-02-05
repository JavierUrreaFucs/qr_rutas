<?php 

  session_start();
  require_once('../model/modelo_administrador.php');

  if (empty($_SESSION['correo']) || $_SESSION['id_tipo_login'] != 1) {
    session_destroy();
    header('location: login.php');
  } else if ( $_SESSION['id_tipo_login'] == 1 ) {
    include('navbar_admin.php');
  } else {
    include('navbar.php');
  }

?>
<main>
  <section>
      <div class="container mt-5 py-1">
        <h1 class="h1">Usuarios Registrados</h1>
        <hr>
        <div class="table-responsive">
          <table class="table table-bordered px-2" id="myTable">
            <thead>
              <tr>
                <th class="th-font table-secondary">ID</th>
                <th class="th-font table-secondary">Nombre completo</th>
                <th class="th-font table-secondary">Tipo de documento</th>
                <th class="th-font table-secondary">N° Documento</th>
                <th class="th-font table-secondary">Correo electr&oacute;nico</th>
                <th class="th-font table-secondary">Tipo de usuario</th>
                <th class="th-font table-secondary">Facultad</th>
                <th class="th-font table-secondary">Fecha de creaci&oacute;n</th>
                <th class="th-font table-secondary">Fecha de &uacute;ltimo ingreso</th>
                <th class="th-font table-secondary">Administrar</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            // Ver tabla de usuarios
              $vistaUsuario = new Consultas_admin();
              $resReserva = $vistaUsuario->verUsuarios(1);
              foreach ($resReserva as $rowReserva) {
            ?>
              <tr>
                <td class="th-font"><?php echo $rowReserva['id_login'] ?></td>
                <td class="th-font"><?php echo $rowReserva['nombre_login'] ?></td>
                <td class="th-font"><?php echo $rowReserva['tipo_documento'] ?></td>
                <td class="th-font"><?php echo $rowReserva['num_documento'] ?></td>
                <td class="th-font"><?php echo $rowReserva['correo'] ?></td>
                <td class="th-font"><?php echo $rowReserva['nombre_tipo_login'] ?></td>
                <td class="th-font"><?php echo $rowReserva['facultad_nombre'] ?></td>
                <td class="th-font"><?php echo $rowReserva['fecha_creo_login'] ?></td>
                <td class="th-font"><?php echo $rowReserva['fecha_ultimo_ingreso'] ?></td>
                <td>
                  <div class="row">
                    <?php
                      echo '
                        <div>
                          <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarModal'.$rowReserva["num_documento"].'">
                            Eliminar
                          </button>
                        </div>
                      ';
                    ?>
                  </div>
                </td>
              </tr>
              <!-- modal elimnar -->
              <div class="modal" id="eliminarModal<?php echo $rowReserva['num_documento'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Rutas FUCS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../controller/controlador_administrador.php" method="POST">
                      <div class="modal-body">
                        <p>¿Está seguro de eliminar el usuario <?php echo $rowReserva['num_documento'] ?>?</p>
                      </div>
                      <div class="modal-footer">
                      <input type="hidden" name="id_usuario" value="<?php echo $rowReserva['id_login'] ?>">
									      <input type="hidden" name="documento" value="<?php echo $rowReserva['num_documento'] ?>">
                        <button type="submit" class="btn btn-outline-danger" name="eliminar_usuario" >Eliminar</button>
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php }?>
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
  document.title = "Rutas FUCS | Usuarios";
</script>
<!-- DataTables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>
<script src="./js/dataTables.js"></script>
<?php include('footer.php') ?>