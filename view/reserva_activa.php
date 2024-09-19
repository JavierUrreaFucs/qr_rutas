<?php

// Verificar si el usuario tiene una reserva para la fecha actual
$hoy = date('Y-m-d');
$idUsuario = $_POST['documento'];

$reservaExistente = new Consultas_admin();
$resultadoConsulta = $reservaExistente->verificarReservaExistente($idUsuario, $hoy);

if ($resultadoConsulta->num_rows > 0) {
    // El usuario ya tiene una reserva para hoy
    echo "<script>alert('Estimado usuario, ya cuenta con una reserva para el día de hoy. Si desea hacer otra, debe realizar el pago del cupo reservado en tesorería.');</script>;";
    // Puedes redirigirlo a otra página o mostrar un mensaje de error.
    // Por ejemplo: header('Location: otra_pagina.php');
    // O puedes mostrar un mensaje y detener la ejecución del código.
    echo '<script>document.location.href="../view/reservar.php";</script>';

  } else {

    return false;

  }

?>
  