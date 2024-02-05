<?php
//error_reporting(1);
require_once("../model/modelo_administrador.php");

// creacion de usuarios
if (isset($_POST['registrar'])) {
  $tipoDoc = $_POST['tipoDocumento'];
  $numDoc = $_POST['documento'];
  $nombre = $_POST['nombre'];
  $tipoUsuario = $_POST['tipoUsuario'];
  $facultad = $_POST['facultad'];
  $correo = $_POST['correo'];
  $password = $_POST['password'];

  $opcionAdd = new Consultas_admin();
  $opcionAdd->crear_usuario($tipoDoc, $numDoc, $nombre, $tipoUsuario, $facultad, $correo, $password);

  echo '<script language="javascript">alert("Se ha registrado con exito")</script>';
  echo '<script>document.location.href="../view/login.php"</script>';

}
// reservar cupo
else if(isset($_POST['reservar'])) {
  $nombre = $_POST['nombre'];
  $numDoc = $_POST['documento'];
  $facultad = $_POST['facultad'];
  $correo = $_POST['correo'];
  $destino = $_POST['destino'];
  $horario = $_POST['horario'];
  $idLogin = $_POST['idLogin'];
  $tipoUsuario = $_POST['tipoUsuario'];
  $idTipoLogin = $_POST['idTipoLogin'];

  $opcionAdd = new Consultas_admin(); 
  $opcionAdd->creaReserva($nombre,$numDoc,$facultad,$correo,$destino,$horario,$idLogin,$tipoUsuario,$idTipoLogin);

  echo '<script>alert("Se ha generado la reserva con exito")</script>';
  echo '<script>document.location.href="../view/reservar.php"</script>';

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


?>