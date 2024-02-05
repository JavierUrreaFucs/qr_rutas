<?php

require_once("../model/conexion.php");

class Consultas
{

  private $con;
  private $conex;
  private $resultado;
  private $fecha;

  public function __construct()
  {

    $this->con = new Conexion();
    $this->conex = $this->con->conn();
    $this->resultado = array();
    $this->fecha = date("Y-m-d H:i:s");

  }

  // Validacion de usurio en el login
  public function validarUsuario($user, $password)
  {

    $user = mysqli_real_escape_string($this->conex, $user);
    $password = mysqli_real_escape_string($this->conex, $password);

    //Consulta para el login
    $query_query_usuario = "SELECT * FROM login a INNER JOIN tipo_login b ON b.id_tipo_login = a.login_id_tipo
        WHERE correo = '" . $user . "' AND activo_login = 1";
    $query_usuario = mysqli_query($this->conex, $query_query_usuario) or die('No se realizo la conexion a la base de datos');
    $totalRows_query_usuario = mysqli_num_rows($query_usuario); // Cuenta el numero de filas de la consulta

    if ($totalRows_query_usuario == 0) {
      echo '<script language="javascript">alert("Credenciales incorrectas");</script>';
      echo '<script>document.location.href="../view/login.php"</script>';
    } else {
      // recorre la consulta para optener los datos
      while ($row = mysqli_fetch_assoc($query_usuario)) {
        $this->resultado[] = $row;
        // se compara la conraseña insertada con la encriptada en la base de datos
        if (password_verify($password, $row['password'])) {

          return $this->resultado;

        } else {
          echo '<script>
              alert("¡Contraseña incorrecta! Intentalo de nuevo.")
            </script>';
        }
      }
    }
  }

  //Actualiza la fecha del ultimo inicio de sesión
  public function fechaUltimo($id_login)
  {

    $id_login = mysqli_real_escape_string($this->conex, $id_login);

    $consulta = "UPDATE login SET 
          fecha_ultimo_ingreso = '" . $this->fecha . "'
          WHERE id_login = '" . $id_login . "'";

    mysqli_query($this->conex, $consulta) or die("Error al ingresar datos a la Base LOGIN0001");

  }

}
?>