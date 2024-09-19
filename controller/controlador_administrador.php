<?php
//error_reporting(1);
require_once("../model/modelo_administrador.php");

// creacion de usuarios
if (isset($_POST['registrar'])) {
  $nombre = $_POST['nombre'];
  $facultad = $_POST['facultad'];
  $correo = $_POST['correo'];

  $opcionAdd = new Consultas_admin();
  $opcionAdd->crear_usuario($nombre, $facultad, $correo);

  echo '<script language="javascript">alert("Se ha registrado con exito")</script>';
  echo '<script>document.location.href="../view/usuarios.php"</script>';

}
// reservar cupo
else if (isset($_POST['reservar'])) {

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
    $nombre = $_POST['nombre'];
    $numDoc = $_POST['documento'];
    $facultad = $_POST['facultad'];
    $correo = $_POST['correo'];
    $destino = $_POST['destino'];
    $horario = $_POST['horario'];
    $tipoUsuario = $_POST['tipoUsuario'];

    $opcionAdd = new Consultas_admin();
    $opcionAdd->creaReserva($nombre, $numDoc, $facultad, $correo, $destino, $horario, $tipoUsuario);

    echo '<script>alert("Se ha generado la reserva con exito")</script>';
    echo '<script>document.location.href="../view/reservar.php"</script>';
  }
} 
// eliminar una reserva
else if (isset($_POST['eliminar_reserva'])) {

  $idReserva = $_POST['id_reserva'];
  $cedulaReserva = $_POST['cedula_reserva'];
  $ruta = $_POST['rutas_id_rutas'];

  $opcionAdd = new Consultas_admin();
  $opcionAdd->eliminarReserva($idReserva, $cedulaReserva, $ruta);

  echo '<script>alert("Se ha eliminado la reserva")</script>';
  echo '<script>document.location.href="../view/ver_reservas.php"</script>';

}
// pagar una reserva
else if (isset($_POST['pagar_reserva'])) {
  $idReserva = $_POST['id_reserva'];
  $cedulaReserva = $_POST['cedula_reserva'];
  $ruta = $_POST['rutas_id_rutas'];

  $opcionAdd = new Consultas_admin();
  $opcionAdd->pagarReserva($idReserva, $cedulaReserva, $ruta);

  echo '<script>alert("¡El pago de la reserva se realizo con exito!")</script>';
  echo '<script>document.location.href="../view/ver_reservas.php"</script>';
}

// ocultar un usaurio
else if (isset($_POST['eliminar_usuario'])) {
  $idLogin = $_POST['id_usuario'];
  $numDocumento = $_POST['documento'];

  $opcionAdd = new Consultas_admin();
  $opcionAdd->eliminarUsuario($idLogin, $numDocumento);

  echo '<script>alert("¡El usuario ' . $numDocumento . ' fue eliminado de la base de datos!")</script>';
  echo '<script>document.location.href="../view/usuarios.php"</script>';
}

// Cambio de contraseña
else if(isset($_POST['cambiar_pass'])){

	$passactual = $_POST['passactual'];
	$id_login = $_POST['id_login'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
  // Verifica que las contraseñas sean iguales
	if($pass1 == $pass2){
		$dato_password = new Consultas_admin();
	    $password = $dato_password->password($id_login,$pass1,$passactual);
			echo '<script language="javascript">alert("Se realizo el cambio de la contraseña con exito!");</script>'; 
		}else{
			echo '<script language="javascript">alert("La contraseña no es correcta en alguno de los campos!");</script>'; 
		}
   	echo '<script>document.location.href="../view/password.php" </script>';
	}

?>