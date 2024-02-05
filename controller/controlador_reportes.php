<?php

  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  require_once("../model/modelo_administrador.php");
  require_once("../model/modelo_reportes.php");

  // reporte de reservas
  if (isset($_POST['reporte'])) {

  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];
  $tipo_usuario = $_POST['tipo_usuario'];
  $filtro_hora = $_POST['filtra_hora'];

  $date = new DateTime();
  $date = $date->getTimestamp();
  $filename = 'Reporte_convenios_' . $date . '.xls';
  header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-type:application/vnd.ms-excel;charset=UTF-8');
  header('Content-Disposition:attachment;filename="' . $filename . '"');
  header('Cache-Control:max-age=0');
  header('Pragma:no-cache');
  header('Expires:0');
  ?>
    <table border="1">
      <thead>
        <tr>
          <th class="th-font" rowspan="3" colspan="2" align="center"><img src="http://localhost/qr_rutas/view/assets/img/LOGO-FUCS-blanco.png" width="139"></th>
          <th rowspan="2" colspan="9" style="background-color: grey; font-weight: bold" >Planilla</th>
          <th colspan="2">VERSI&Oacute;N: 01</th>
        </tr>
        <tr>
          <th colspan="2">C&Oacute;DIGO:</th>
        </tr>
        <tr>
          <th colspan="9" >Planilla</th>
          <th colspan="2">FECHA: <?php echo date("Y-m-d") ?></th>
        </tr>
        <tr>
          <th class="th-font table-secondary">ID</th>
          <th class="th-font table-secondary">Nombre completo</th>
          <th class="th-font table-secondary">N° Documento</th>
          <th class="th-font table-secondary">Correo electr&oacute;nico</th>
          <th class="th-font table-secondary">Fecha Solicitud</th>
          <th class="th-font table-secondary">Tipo de usuario</th>
          <th class="th-font table-secondary">Facultad</th>
          <th class="th-font table-secondary">Destino</th>
          <th class="th-font table-secondary">Hora</th>
          <th class="th-font table-secondary">valor a pagar</th>
          <th class="th-font table-secondary">Estado</th>
          <th class="th-font table-secondary">Ubicaci&oacute;n</th>
          <th class="th-font table-secondary">Documento a presentar</th>
        </tr>
      </thead>
      <tbody>
       <?php
       $datos_act = new Reportes_admin();
       $valores = $datos_act->reporte_1($fecha_inicio, $fecha_fin, $tipo_usuario, $filtro_hora);
       foreach ($valores as $rowReserva) { ?>
        <tr>
          <td class="th-font"><?php echo $rowReserva['id_reserva'] ?></td>
          <td class="th-font"><?php echo utf8_decode($rowReserva['login_nombre_login']) ?></td>
          <td class="th-font"><?php echo $rowReserva['cedula_reserva'] ?></td>
          <td class="th-font"><?php echo utf8_decode($rowReserva['correo_reserva']) ?></td>
          <td class="th-font"><?php echo $rowReserva['fecha_solicitud'] ?></td>
          <td class="th-font"><?php echo utf8_decode($rowReserva['tipo_login_nombre']) ?></td>
          <td class="th-font"><?php echo utf8_decode($rowReserva['nombre_facultad']) ?></td>
          <td class="th-font"><?php echo utf8_decode($rowReserva['destino_ruta']) ?></td>
          <td class="th-font"><?php echo $rowReserva['horario_ruta'] ?></td>
          <td class="th-font">$ <?php echo $rowReserva['valor_pagar'] ?></td>
          <td class="th-font"><?php echo $rowReserva['reserva_pago'] ?></td>
          <td class="th-font"><?php echo utf8_decode($rowReserva['ubicacion_recogida']) ?></td>
          <td class="th-font"><?php echo utf8_decode($rowReserva['presentar']) ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php }

