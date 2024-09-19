<?php 

session_start();
if ($_SESSION['correo'] != '') {
	session_destroy();
    echo '<script>document.location.href="login.php" </script>';
}else{
  
  echo '<script>document.location.href="reservar.php" </script>';
	
}

?>