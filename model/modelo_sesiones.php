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

  // recuperar contraseña
  function recuperarpassword($correo1, $correo2) {

    // Se usa la función trim() para eliminar espacios en blanco al principio y al final del correo electrónico
    $correo1 = trim($correo1);
    $correo2 = trim($correo2);
    // Verificar si los dos correos son iguales
    if ($correo1 == $correo2) {

        $activo = 1;
        // Realizar una consulta para obtener los datos del usuario
        $query1 = "SELECT * FROM login WHERE correo = ? AND activo_login = ?";
        $stmt = $this->conex->prepare($query1);
        $stmt->bind_param('si', $correo1, $activo);
        $stmt->execute();
        $resConsulta = $stmt->get_result();

        // Verificar si la consulta no devuelve ningún resultado.
        if ($resConsulta->num_rows > 0) {
            // Generar una nueva contraseña segura
            $numero = random_bytes(8); // Puedes ajustar la longitud según tus necesidades
            $contrasenia = password_hash($numero, PASSWORD_DEFAULT);

            // Actualizar el campo de la contraseña en la base de datos
            $query2 = "UPDATE login SET password = ? WHERE correo = ? AND activo_login = ?";
            $stmt2 = $this->conex->prepare($query2);
            $stmt2->bind_param('ssi', $contrasenia, $correo1, $activo);
            $stmt2->execute();
            if (!$stmt2) {
              throw new Exception("Error al preparar la consulta de actualización de contraseña: " . $this->conex->error);
          }
            $stmt2->close();

            // Enviar correo de recuperación
            require_once("../view/correo.php");
            $query = new CorreoManager();
            $datos = $query->recuperacionpass($numero, $correo1);

            echo '<script language="javascript">alert("Se envió la nueva contraseña a su correo.");</script>';
        } else {
            echo '<script language="javascript">alert("El correo informado no está disponible en la base de datos, informe al administrador del sistema.");</script>';
        }

        $stmt->close();
    } else {
        echo '<script language="javascript">alert("Los campos indicados no son iguales, intente nuevamente.");</script>';
    }
  }

}

?>