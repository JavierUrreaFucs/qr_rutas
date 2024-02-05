<?php
// Verifica si ya hay una reserva activa y falta por pagarla

  $consul_reserva = new Consultas_admin();
  $reserva = $consul_reserva->resActiva($_SESSION['correo']);

  if ($reserva->num_rows > 0) {
    echo '
      <script>
        alert("Tiene una reserva activa.");
      </script>
    ';
    session_destroy();
  } else {
    return false;
  }