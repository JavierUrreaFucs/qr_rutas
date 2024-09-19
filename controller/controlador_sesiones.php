<?php
error_reporting(E_ERROR);
session_start();

require_once("../model/modelo_sesiones.php");

//iniciar sesión
if(isset($_POST['acceder'])){

  $user = $_POST['user'];
  $password = $_POST['password'];

  if ($user == "" || $password == "") {

    echo "<script>
	       alert('Debe llenar los campos requeridos');
	       window.history.go(-1);
	  </script>";

  } else {
    
    $valores = new Consultas();
	  $valorSession = $valores->validarUsuario($user,$password);

    foreach ($valorSession as $keySession){
      $correo = $keySession['correo'];
      $idLogin = $keySession['id_login'];
      $nombreLogin = $keySession['nombre_login'];
      $cedula = $keySession['num_documento'];
      $facultad = $keySession['facultad_nombre'];
      $tipoLogin = $keySession['nombre_tipo_login'];
      $loginIdTipo = $keySession['id_tipo_login'];
    }

    $fechaUltima = new Consultas();
    $fechaUltima->fechaUltimo($idLogin);

    $_SESSION['correo'] = $correo;
    $_SESSION['id_login'] = $idLogin;
    $_SESSION['nombre_login'] = $nombreLogin;
    $_SESSION['num_documento'] = $cedula;
    $_SESSION['facultad_nombre'] = $facultad;
    $_SESSION['nombre_tipo_login'] = $tipoLogin;
    $_SESSION['id_tipo_login'] = $loginIdTipo;

    // Advertencia: si se elimina el echo no iniciara sesión
    echo '<script>
      document.location.href="../view/home.php";
      </script>';
    exit;
  }

} else if(isset($_POST['recuperarcontrasenia'])){

	$correo1 = $_POST['correo1'];
	$correo2 = $_POST['correo2'];
	$query = new Consultas();
  $datos = $query->recuperarpassword($correo1,$correo2);
	echo '<script>document.location.href="../view/login.php"</script>';
}
?>