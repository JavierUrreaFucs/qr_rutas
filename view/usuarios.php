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
    <div class="container mt-5 py-5 pt-5">
      <h1 class="h1">Usuarios Registrados</h1>
      <hr>
      <div class="py-2">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Crear usuario
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered px-2" id="myTable">
          <thead>
            <tr>
              <th class="th-font table-secondary">ID</th>
              <th class="th-font table-secondary">Nombre completo</th>
              <th class="th-font table-secondary">Correo electrónico</th>
              <th class="th-font table-secondary">Tipo de usuario</th>
              <th class="th-font table-secondary">Facultad</th>
              <th class="th-font table-secondary">Fecha de creación</th>
              <th class="th-font table-secondary">Fecha de último ingreso</th>
              <th class="th-font table-secondary">Administrar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Ver tabla de usuarios
            $vistaUsuario = new Consultas_admin();
            $resUsuario = $vistaUsuario->verUsuarios(1);
            foreach ($resUsuario as $rowUsuario) {
            ?>
              <tr>
                <td class="th-font"><?php echo $rowUsuario['id_login'] ?></td>
                <td class="th-font"><?php echo $rowUsuario['nombre_login'] ?></td>
                <td class="th-font"><?php echo $rowUsuario['correo'] ?></td>
                <td class="th-font"><?php echo $rowUsuario['nombre_tipo_login'] ?></td>
                <td class="th-font"><?php echo $rowUsuario['facultad_nombre'] ?></td>
                <td class="th-font"><?php echo $rowUsuario['fecha_creo_login'] ?></td>
                <td class="th-font"><?php echo $rowUsuario['fecha_ultimo_ingreso'] ?></td>
                <td>
                  <div class="row">
                    <?php
                    echo '<div><button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarModal' . $rowUsuario["id_login"] . '">Eliminar</button>
                        </div>';
                    ?>
                  </div>
                </td>
              </tr>
              <!-- modal elimnar -->
              <div class="modal" id="eliminarModal<?php echo $rowUsuario['id_login'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Rutas FUCS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../controller/controlador_administrador.php" method="POST">
                      <div class="modal-body">
                        <p>¿Está seguro de eliminar el usuario <strong><?php echo $rowUsuario['nombre_login'] ?></strong>?</p>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="id_usuario" value="<?php echo $rowUsuario['id_login'] ?>">
                        <button type="submit" class="btn btn-outline-danger" name="eliminar_usuario">Eliminar</button>
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    </div>
  </section>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form" action="../controller/controlador_administrador.php" method="POST">
            <div class="form-group p-2 col-">
              <label for="nombre">Nombre completo <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre completo"
                required>
            </div>
            <div class="form-group p-2 col-12">
              <label for="nombre">Facultad a la que pertenece <span class="text-danger">*</span></label>
              <select class="form-select" name="facultad" id="facultad" required>
                <option value="">Seleccione una opción
                  <?php
                  $valore = new Consultas_admin();
                  $tipoFacul = $valore->verFacultad(1);
                  foreach ($tipoFacul as $rowFacul) {
                    echo "<option value='" . $rowFacul['nombre_facultad'] . "'> " . $rowFacul['nombre_facultad'] . "</option>";
                  }
                  ?>
                </option>
              </select>
            </div>
            <div class="form-group p-2 col-12">
              <label for="correo">Correo Insitucional <span class="text-danger">*</span></label>
              <input class="form-control" id="correo" type="email" name="correo" required oninput="validarCorreo()">
              <div id="error-message" class="text-danger my-1 mx-2 error-message"></div>
            </div>
            <div class="row">
              <div class="col-6 py-2 px-2">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary btncolor" name="registrar">Guardar</button>
                </div>
              </div>
              <div class="col-6 py-2 px-2">
                <div class="d-grid gap-2">
                  <button type="button" class="btn btn-warning botonamarillo" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
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