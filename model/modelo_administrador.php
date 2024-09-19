<?php

require_once("../model/conexion.php");
require_once("../view/correo.php");

class Consultas_admin {

	private $con;
	private $conex;
	private $resultado;
	private $fecha;

	function __construct()
	{
		$this->con = new Conexion();
		$this->conex = $this->con->conn();
		$this->resultado = array();
		$this->fecha = date("Y-m-d H:i:s");
	}

	// Verificar si el usuario ya existe
	public function usuarioExistente($correo) {
    // Escapar las variables para prevenir inyecciones SQL
    $correo = mysqli_real_escape_string($this->conex, $correo);

    // Consulta para verificar si ya existe un usuario con el número de documento o correo
    $consulta = "SELECT COUNT(*) as count FROM login WHERE  correo = ?";
    
    // Preparar la consulta
    $stmt = $this->conex->prepare($consulta);
    
    // Vincular parámetros
    $stmt->bind_param('s', $correo);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener el resultado
    $resultado = $stmt->get_result();
    // Obtener el número de filas encontradas
    $fila = $resultado->fetch_assoc();
    $count = $fila['count'];
    // Cerrar la consulta
    $stmt->close();
    // Devolver true si ya existe un usuario con el número de documento o correo, de lo contrario, false
    return $count > 0;
	}

	// Registro de usuarios
	public function crear_usuario($nombre, $facultad, $correo) {
		// Verificar si ya existe un usuario con el número de documento o correo
    if ($this->usuarioExistente($correo)) {
			echo '
				<script>
					alert("Ya existe un usuario registrado con ese correo electrónico. Inténtelo de nuevo o comuníquese con el administrador del sitio.")
				</script>
			';
			
  		echo '<script>document.location.href="../view/usuarios.php"</script>';
		}
		// Escapar las variables para prevenir inyecciones SQL
		$nombre = mysqli_real_escape_string($this->conex, $nombre);
		$facultad = mysqli_real_escape_string($this->conex, $facultad);
		$correo = mysqli_real_escape_string($this->conex, $correo);

		$password = "Fucsalud123*";

		$passEncript = password_hash($password, PASSWORD_DEFAULT);
		// Para mayor seguridad se usará consultas preparadas
		// Insertar datos con consulta preparada
		$consulta = "INSERT INTO login (
			nombre_login,
			facultad_nombre,
			correo,
			password,
			fecha_creo_login,
			fecha_actualizacion_login,
			fecha_ultimo_ingreso
			) VALUES (?, ?, ?, ?, ?, ?, ?)";
		// Preparar la consulta
		$stmt = $this->conex->prepare($consulta);
		// vincula parametros
		$stmt->bind_param(
			'sssssss',
			$nombre,
			$facultad,
			$correo,
			$passEncript,
			$this->fecha,
			$this->fecha,
			$this->fecha
		);
		// Ejecutar la consulta
		$stmt->execute();
		// Manejo de errores
		if (!$stmt) {
			throw new Exception("Error al preparar la consulta: COD000001" . $this->conex->error);
		}
		// Se cierra la consulta y la conexión a la base de datos
		$stmt->close();
		mysqli_close($this->conex);
	}

	// ver usuarios
	public function verUsuario($idUsuario) {
		// Consulta preparada
		$select = "SELECT * FROM login WHERE id_login = ?";
		$stmt = $this->conex->prepare($select);
		$stmt->bind_param("s", $idUsuario); // inserta datos a la consulta
		$stmt->execute();
		// Recorre la base de datos y almacena en un array
		$resultado = $stmt->get_result();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$this->resultado[] = $row;
		}
		// Cerrar las conexiones
		$stmt->close();
		mysqli_close($this->conex);
		return $resultado;
	}

	// Ver las facultades
	public function verFacultad($activo) {
		// Consulta preparada
		$select = "SELECT * FROM facultad WHERE activo_facultad = ?";
		$stmt = $this->conex->prepare($select);
		$stmt->bind_param("s", $activo); // inserta datos a la consulta
		$stmt->execute();
		// Recorre la base de datos y almacena en un array
		$resultado = $stmt->get_result();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$this->resultado[] = $row;
		}
		// Cerrar las conexiones
		$stmt->close();
		mysqli_close($this->conex);
		return $resultado;
	}

	// Ver Rutas de la FUCS
	public function verRutas($activo) {
		// Consulta preparada
		$select = "SELECT * FROM rutas WHERE activo_rutas = ?";
		$stmt = $this->conex->prepare($select);
		$stmt->bind_param("s", $activo); // Insertar datos a la consulta
		$stmt->execute();
		// Recorre la base de datos y almacena en un array
		$resultado = $stmt->get_result();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$this->resultado[] = $row;
		}
		//Cerrar las conexiones
		$stmt->close();
		mysqli_close($this->conex);
		return $resultado;
	}

	// Ver tipo de login
	public function verTipoLogin($activo) {
		// Consulta preparada
		$select = "SELECT * FROM tipo_login WHERE activo_tipo = ?";
		$stmt = $this->conex->prepare($select);
		$stmt->bind_param("s", $activo); // Insertar datos en la consulta
		$stmt->execute();
		// Recorre la base de datos y almacena en un array
		$resultado = $stmt->get_result();
		while ($row = mysqli_fetch_assoc($resultado)) {
			$this->resultado[] = $row;
		}
		//Cerrar las conexiones
		$stmt->close();
		mysqli_close($this->conex);

		return $resultado;
	}

	// Reservar puesto
	public function creaReserva($nombre, $numDoc, $facultad, $correo, $destino, $horario, $tipoUsuario) {
		// Realizar la consulta SQL para obtener la información de la ruta
		// Para mayor seguridad se usará consultas preparadas
		$consult = "SELECT * FROM rutas WHERE id_rutas = ?";
		$stmt = $this->conex->prepare($consult);
		$stmt->bind_param("i", $horario);
		$stmt->execute();
		$consulta_res = $stmt->get_result();

		while ($rowUser = $consulta_res->fetch_assoc()) {
			// se descuenta un cupo de la ruta especificada
			$limite = $rowUser['cupo'] - 1;
			// se actualza el campo cupo de la tabla rutas con los nuevos cupos disponibles
			$newCupo = "UPDATE rutas SET cupo = ? WHERE id_rutas = ?";
			$stmtCupo = $this->conex->prepare($newCupo);
			$stmtCupo->bind_param("ii", $limite, $horario);
			$stmtCupo->execute();
			$stmtCupo->close();
			// se valida el tipo de usuario y se cobra si es estudiante (2)
			if ($tipoUsuario == "Estudiante") {
				$valorPagar = 1000;
				$reservaPago = "Pendiente pago";
			} else { // si no es estudiante no se le cobra
				$valorPagar = 0;
				$reservaPago = "Pagado";
			}
			// Insertar datos con consulta preparada
			$insertReserva = "INSERT INTO reservas (nombre_usuario, cedula_reserva, correo_reserva, fecha_solicitud, tipo_login_nombre, nombre_facultad, rutas_id_rutas, destino_ruta, horario_ruta, valor_pagar, reserva_pago) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
			// Preparar la consulta
			$stmt = $this->conex->prepare($insertReserva);
			// vincula parametros
			$stmt->bind_param("sssssssssss", $nombre, $numDoc, $correo, $this->fecha, $tipoUsuario, $facultad, $horario, $destino, $rowUser['horario'], $valorPagar, $reservaPago);
			// Ejecutar la consulta
			$stmt->execute();
			// Manejo de errores
			if ($stmt->error) {
				throw new Exception("Error al ejecutar la consulta: COD000005" . $stmt->error);
			}
			// Se cierra la consulta y la conexión a la base de datos
			$stmt->close();
		}
		$correoReserva = new CorreoManager();
		$correoReserva->enviarCorreoReserva($nombre, $correo, $horario, $destino, $reservaPago);
		mysqli_close($this->conex);
	}

	public function verReservas($activo) {

		$activo = mysqli_real_escape_string($this->conex, $activo);

		$consulReserva = "SELECT * FROM reservas a INNER JOIN rutas b ON b.id_rutas = a.rutas_id_rutas WHERE b.activo_rutas = ?";
		$stmt = $this->conex->prepare($consulReserva);
		$stmt->bind_param("s", $activo);
		$stmt->execute();
		$resultado = $stmt->get_result();
		$stmt->close();
		return $resultado;

	}
	/*
		public function verReservasFiltradas($fechaInicio, $fechaFin, $horarioFiltro) {
			$like = '%'.$horarioFiltro.'%';

			$query = "SELECT * FROM reservas a INNER JOIN rutas b ON b.id_rutas = a.rutas_id_rutas WHERE (a.fecha_solicitud BETWEEN ? AND ?) OR (b.horario LIKE ?)";
			$stmt = $this->conex->prepare($query);
			$stmt->bind_param('sss', $fechaInicio, $fechaFin, $like);
			$stmt->execute();

			$result = $stmt->get_result();
			// Verificar si la consulta fue exitosa
			if ($result) {
				$reservas = $result->fetch_all(MYSQLI_ASSOC); // Aquí es MYSQLI_ASSOC, no MYSQL_ASSOC
				$result->close();
				return $reservas;
			} else {
				return false;
			}
			
		}
	*/
	public function verReservasFiltradas($fechaInicio, $fechaFin, $horarioFiltro) {
		// Verificar si se proporciona un horario
		if (!empty($horarioFiltro)) {
			$like = ''. $horarioFiltro .'';

			$query = "SELECT * FROM reservas a INNER JOIN rutas b ON b.id_rutas = a.rutas_id_rutas WHERE (DATE(a.fecha_solicitud) BETWEEN ? AND ?) OR (b.horario = ?)";
			$stmt = $this->conex->prepare($query);
			$stmt->bind_param('sss', $fechaInicio, $fechaFin, $like);
			$stmt->execute();

			$result = $stmt->get_result();

			// Verificar si la consulta fue exitosa
			if ($result && $result->num_rows > 0) {
				$reservas = $result->fetch_all(MYSQLI_ASSOC);
				$result->close();
				return $reservas;
			} else {
				// No se encontraron reservas con el horario y las fechas especificados
				return [];
			}
		} else {
			// Si no se proporciona un horario, realizar el filtrado solo por fechas
			$query = "SELECT * FROM reservas a INNER JOIN rutas b ON b.id_rutas = a.rutas_id_rutas WHERE (DATE(a.fecha_solicitud) BETWEEN ? AND ?)";
			$stmt = $this->conex->prepare($query);
			$stmt->bind_param('ss', $fechaInicio, $fechaFin);
			$stmt->execute();

			$result = $stmt->get_result();

			// Verificar si la consulta fue exitosa
			if ($result && $result->num_rows > 0) {
				$reservas = $result->fetch_all(MYSQLI_ASSOC);
				$result->close();
				return $reservas;
			} else {
				// No se encontraron reservas con las fechas especificadas
				return [];
			}
		}
	}

	//Ver Usuarios
	public function verUsuarios($activo) {

		$activo = mysqli_real_escape_string($this->conex, $activo);

		$consulReserva = "SELECT * FROM login a INNER JOIN tipo_login b ON a.login_id_tipo = b.id_tipo_login WHERE activo_login = ?";
		$stmt = $this->conex->prepare($consulReserva);
		$stmt->bind_param("s", $activo);
		$stmt->execute();
		$resultado = $stmt->get_result();
		$stmt->close();
		return $resultado;

	}

	public function selectReserva($fechaInicio, $horarioFiltro) {

		$like1 = '%' . $fechaInicio . '%';
		$like2 = '%' . $horarioFiltro . '%';

		$consulta = "SELECT * FROM reservas WHERE fecha_solicitud Like ? AND horario_ruta like ?";
		$stmt = $this->conex->prepare($consulta);
		$stmt->bind_param('ss', $like1, $like2);
		$stmt->execute();

		$result = $stmt->get_result();
		// Verificar si la consulta fue exitosa
		if ($result) {
			$reservas = $result->fetch_all(MYSQLI_ASSOC); // Aquí es MYSQLI_ASSOC, no MYSQL_ASSOC
			$result->close();
			return $reservas;
		} else {
			return false;
		}

	}

	//descargar reporte
	public function reporte($fechaInicio, $fechaFin, $tipo_usuario, $horarioFiltro) {
		// Verificar si se proporciona un horario
		$like1 = '%' . $horarioFiltro . '%';
		$query = "SELECT * FROM reservas a INNER JOIN rutas b ON b.id_rutas = a.rutas_id_rutas WHERE (DATE(a.fecha_solicitud) BETWEEN ? AND ?) AND b.horario LIKE ? AND a.tipo_login_nombre = ?";
		$stmt = $this->conex->prepare($query);
		$stmt->bind_param('ssss', $fechaInicio, $fechaFin, $like1, $tipo_usuario);
		$stmt->execute();
		$result = $stmt->get_result();
		// Verificar si la consulta fue exitosa
		if ($result && $result->num_rows > 0) {
			$reservas = $result->fetch_all(MYSQLI_ASSOC);
			$result->close();
			return $reservas;
		} else {
			// No se encontraron reservas con el horario y las fechas especificados
			return [];
		}
	} 

	//Eliminar reservas
	public function eliminarReserva($idReserva,$cedulaReserva,$ruta){

		$eliminar = "DELETE FROM reservas WHERE id_reserva = ? AND cedula_reserva = ? ";
		$stmt = $this->conex->prepare($eliminar);
		$stmt->bind_param('ii', $idReserva, $cedulaReserva);
		$stmt->execute();
		// Manejo de errores
		if (!$stmt) {
			throw new Exception("Error al preparar la consulta: COD000006" . $this->conex->error);
		}
		// Se cierra la consulta y la conexión a la base de datos
		$stmt->close();

		$cupo = "UPDATE rutas SET cupo = cupo + 1 WHERE id_rutas = ?";
		$stmt2 = $this->conex->prepare($cupo);
		$stmt2->bind_param('i', $ruta);
		$stmt2->execute();
		// Manejo de errores
		if (!$stmt2) {
			throw new Exception("Error al preparar la consulta: COD000007" . $this->conex->error);
		}
		// Se cierra la consulta y la conexión a la base de datos
		$stmt2->close();

	}

	//Eliminar reservas
	public function pagarReserva($idReserva,$cedulaReserva,$ruta){

		$valor = "Pagado";

		$pago = "UPDATE reservas SET reserva_pago = ? WHERE id_reserva = ? AND cedula_reserva = ?";
		$stmt = $this->conex->prepare($pago);
		$stmt->bind_param('sii', $valor, $idReserva, $cedulaReserva);
		$stmt->execute();
		// Manejo de errores
		if (!$stmt) {
			throw new Exception("Error al preparar la consulta: COD000008" . $this->conex->error);
		}
		// Se cierra la consulta y la conexión a la base de datos
		$stmt->close();

	}

	// Ocultar usuario
	public function eliminarUsuario($idLogin, $numDocumento){

		$desactivar = "UPDATE login SET activo_login = 0 WHERE id_login = ? AND num_documento = ? ";
		$stmt = $this->conex->prepare($desactivar);
		$stmt->bind_param('ii', $idLogin, $numDocumento);
		$stmt->execute();
		// Manejo de errores
		if (!$stmt) {
			throw new Exception("Error al preparar la consulta: COD000009" . $this->conex->error);
		}
		// Se cierra la consulta y la conexión a la base de datos
		$stmt->close();

	}

	// Verifica si ya hay una reserva
	public function verificarReservaExistente($idUsuario, $hoy) {

		$pago = 'Pendiente pago';

		$sql = "SELECT * FROM reservas WHERE cedula_reserva = ? AND DATE(fecha_solicitud) = ? AND reserva_pago = ?";
		$stmt = $this->conex->prepare($sql);
		$stmt->bind_param('iss', $idUsuario, $hoy, $pago);
		$stmt->execute();
		$result = $stmt->get_result();
    $stmt->close();  

    // Devuelve el resultado (puedes procesarlo más según tus necesidades)
    return $result;
		
	}

	// Cambiar contraseña
	public function password($id_login, $pass, $passactual) {
    $activo = 1;
    
    // Consulta preparada
    $qry = "SELECT password FROM login WHERE id_login = ? AND activo_login = ?";
    $stmt = $this->conex->prepare($qry);
    $stmt->bind_param('ii', $id_login, $activo);
    $stmt->execute();
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: COD000010" . $this->conex->error);
    }
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verificar si la contraseña actual es correcta
    if (password_verify($passactual, $hashedPassword)) {
      // La contraseña actual es correcta, se procede a actualizar
      $pass_new = password_hash($pass, PASSWORD_DEFAULT);
      
      // Se actualiza el password y la fecha de actualización
      $passq = "UPDATE login SET password = ?, fecha_actualizacion_login = ? WHERE id_login = ?";
      $stmt2 = $this->conex->prepare($passq);
      $stmt2->bind_param('ssi', $pass_new, $this->fecha, $id_login);
      $stmt2->execute();
      if (!$stmt2) {
          throw new Exception("Error al preparar la consulta: COD000011" . $this->conex->error);
      }
      $stmt2->close();
    } else {
      // La contraseña actual no es correcta
      echo '<script language="javascript">alert("La contraseña actual no es correcta");</script>'; 
      echo '<script>document.location.href="../view/password.php" </script>';
    }
	}


}
