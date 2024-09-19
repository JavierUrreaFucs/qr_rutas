<?php

require_once("../model/modelo_administrador.php");

include("ver_rutas.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
    <!--end bootstrap -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title id="title">Rutas FUCS</title>
</head>

<header>
    <nav class="navbar navbar-expand-lg color-nav">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#"><img class="img-fluid" src="../view/assets/img/LOGO-FUCS-fondo-Azul-Fundadores.png" width="120" alt="Logo Fucs"></a>
            <button class="navbar-toggler bg-secondary-subtle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="iconavbar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-lg-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-warning" aria-current="page" href="login.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="bg-body-tertiary">
    <!-- Formulario de registro-->
    <section class="container bg-white my-5">
        <div class="p-3">
            <h1 class="h1">Generar reserva</h1>
            <hr>
            <form id="form" action="../controller/controlador_administrador.php" method="POST">
                <div class="form-group p-2 col-md-6">
                    <label>Nombre completo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nombre">
                </div>
                <div class="row">
                    <div class="form-group p-2 col-md-6">
                        <label for="documento">Número de identificación <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="documento">
                    </div>
                    <div class="form-group p-2 col-md-6">
                        <label for="facultad">Tipo de usuario <span class="text-danger">*</span></label>
                        <select type="text" class="form-control" name="tipoUsuario">
                            <option value="" selected>Selecione una opción</option>
                            <option value="Estudiante">Estudiante</option>
                            <option value="Docente">Docente</option>
                            <option value="Administrativo">Administrativo</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group p-2 col-md-6">
                        <label for="correo">Correo Insitucional <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="correo">
                    </div>
                    <div class="form-group p-2 col-md-6">
                        <label for="facultad">Facultad a la que pertenece <span class="text-danger">*</span></label>
                        <select type="text" class="form-control" name="facultad">
                            <option value="" selected>Selecione una opción</option>
                            <?php
                            $selectFacultad = new Consultas_admin();
                            $verFacultad = $selectFacultad->verFacultad(1);
                            foreach ($verFacultad as $rowFacultad) {
                            ?>
                                <option value="<?php echo $rowFacultad['nombre_facultad'] ?>"><?php echo $rowFacultad['nombre_facultad'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="form-group p-2 col-md-6">
                        <label for="correo">Selecione la ruta de destino <span class="text-danger">*</span></label>
                        <select class="form-select" name="destino" required>
                            <option value="" selected>Selecione una opción</option>
                            <option value="Sede centro - Sede norte">Sede centro - Sede norte</option>
                            <option value="Sede norte - Sede centro">Sede norte - Sede centro</option>
                        </select>
                    </div>
                    <div class="form-group p-2 col-md-6">
                        <label for="horario">Horario <span class="text-danger">*</span></label>
                        <select class="form-select" name="horario" required>
                            <option value="">Selecione una opción</option>
                            <?php
                            $valorRuta = new Consultas_admin();
                            $destinoRuta = $valorRuta->verRutas(1);
                            foreach ($destinoRuta as $rowRuta) {
                                echo "<option value='" . $rowRuta['id_rutas'] . "'>" . $rowRuta['horario'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="px-2">
                    <button type="submit" class="btn btn-primary" name="reservar">Reservar</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include('footer.php') ?>