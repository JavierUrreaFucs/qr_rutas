<?php 
  
  $valorRuta = new Consultas_admin();
  $destinoRuta = $valorRuta->verRutas(1);

  $todasLasRutasSinCupos = true;

  foreach ($destinoRuta as $rowRuta) {
      if ($rowRuta['cupo'] != 0) {
          $todasLasRutasSinCupos = false;
          break;  // Salir del bucle si encuentra al menos una ruta con cupos
      }
  }

  if ($todasLasRutasSinCupos) {
      echo "<script>alert('En estos momentos no hay cupos disponibles en ninguna de nuestras rutas.')</script>";
      echo '<script>document.location.href="../view/perfil.php"</script>';
  } else {
      foreach ($destinoRuta as $rowRuta) {
          if ($rowRuta['cupo'] == 0) {
              $mensaje = sprintf("La ruta con destino a la SEDE %s en horario de %s, NO cuenta con cupos disponibles.",
                  ($rowRuta['id_rutas'] == 1 || $rowRuta['id_rutas'] == 2) ? 'NORTE' : 'CENTRO',
                  ($rowRuta['id_rutas'] == 1) ? '11:20 a.m' : (($rowRuta['id_rutas'] == 2) ? '12:30 a.m' : (($rowRuta['id_rutas'] == 3) ? '12:00 m' : '1:10 p.m'))
              );
              echo "<script>alert('$mensaje')</script>";
          }
      }
  }

?>