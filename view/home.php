<?php 
  session_start();
  require_once('../model/modelo_administrador.php');

  if (empty($_SESSION['correo']) || $_SESSION['id_tipo_login'] != 1) {
    session_destroy();
    header('location: login.php');
  } else {
    include('navbar.php');
  }
?>
<main>
  <section>
    <article class="container-fluid pt-md-5 resdeldia">
      <h1 class="h1 text-center">Reservas del día</h1>
      <hr>
      <div class="row m-auto py-2 px-md-5 card-homeg">
        <div class="col-3">
          <div class="card text-center text-white h-100 card-home">
            <i class="bi bi-bus-front-fill pt-3 icon-size"></i>
            <div class="card-body">
              <h5 class="card-title">Ruta 1</h5>
              <p class="card-text">Sede centro - Sede norte<br>11:20 a.m.</p>
              <p class="card-text">
                <?php 
                  $vista1 = new Consultas_admin();
                  $hora1 = date("Y-m-d");
                  $hora2 = date("Y-m-d");
	                $dato1 = $vista1->selectReserva($hora1, '11:20 a.m');
	                echo '<form action="ver_reservas.php" method="POST">
		            	  <input type="hidden" name="filtra_hora" value="11:20 a.m">
                    <input type="hidden" name="fecha_inicio" value="'.$hora1.'">
                    <input type="hidden" name="fecha_fin" value="'.$hora2.'">
		            	  <button type="submit" class="contar" name="filtra-reserva">'.count($dato1).'<br>Reservas</button>
		            	</form>';
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-center text-white h-100 card-home">
            <i class="bi bi-bus-front-fill pt-3 icon-size"></i>
            <div class="card-body">
              <h5 class="card-title">Ruta 2</h5>
              <p class="card-text">Sede centro - Sede norte<br>12:30 p.m.</p>
              <p class="card-text">
                <?php 
                  $vista2 = new Consultas_admin();
	                $fecha = date("Y-m-d");
	                $dato2 = $vista2->selectReserva($hora1, '12:30 p.m');
	                echo '<form action="ver_reservas.php" method="POST">
		            	  <input type="hidden" name="filtra_hora" value="12:30 p.m">
                    <input type="hidden" name="fecha_inicio" value="'.date("mm/dd/yyyy").'">
                    <input type="hidden" name="fecha_fin" value="'.date("mm/dd/yyyy").'">
		            	  <button type="submit" class="contar" name="filtra-reserva">'.count($dato2).'<br>Reservas</button>
		            	</form>';
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-center text-white h-100 card-home">
            <i class="bi bi-bus-front-fill pt-3 icon-size"></i>
            <div class="card-body">
              <h5 class="card-title">Ruta 3</h5>
              <p class="card-text">Sede norte - Sede centro<br>12:00 m.</p>
              <p class="card-text">
                <?php 
                  $vista3 = new Consultas_admin();
	                $hora1 = date("Y-m-d");
	                $dato3 = $vista3->selectReserva($hora1, '12:00 m');
	                echo '<form action="ver_reservas.php" method="POST">
		            	  <input type="hidden" name="filtra_hora" value="12:00 m">
                    <input type="hidden" name="fecha_inicio" value="'.date("mm/dd/yyyy").'">
                    <input type="hidden" name="fecha_fin" value="'.date("mm/dd/yyyy").'">
		            	  <button type="submit" class="contar" name="filtra-reserva">'.count($dato3).'<br>Reservas</button>
		            	</form>';
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-center text-white h-100 card-home">
            <i class="bi bi-bus-front-fill pt-3 icon-size"></i>
            <div class="card-body">
              <h5 class="card-title">Ruta 4</h5>
              <p class="card-text">Sede norte - Sede centro<br>1:10 p.m.</p>
              <p class="card-text">
                <?php 
                  $vista4 = new Consultas_admin();
	                $hora1 = date("Y-m-d");
	                $dato4 = $vista1->selectReserva($hora1, '1:10 p.m');
	                echo '<form action="ver_reservas.php" method="POST">
		            	  <input type="hidden" name="filtra_hora" value="1:10 p.m">
                    <input type="hidden" name="fecha_inicio" value="'.date("mm/dd/yyyy").'">
                    <input type="hidden" name="fecha_fin" value="'.date("mm/dd/yyyy").'">
		            	  <button type="submit" class="contar" name="filtra-reserva">'.count($dato4).'<br>Reservas</button>
		            	</form>';
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </article>
  </section>
</main>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<?php include('footer.php') ?>