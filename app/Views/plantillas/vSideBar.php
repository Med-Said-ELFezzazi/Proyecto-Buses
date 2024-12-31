<nav id="sidebar" class="active">
    <h1><a href="index.html" class="logo">BUS</a></h1>
    <ul class="list-unstyled components mb-5">
        <!-- Sin session -->
        <?php if (!session()->get('dniCliente')):?>
            <!-- Si ya haya pulsado 'sin session' -->
            <?php
                $ultimoSegmento = explode('/', current_url());
                $ultimoSegmento = end($ultimoSegmento);
            ?>
            <?php if ($ultimoSegmento == 'visitante' || $ultimoSegmento == 'lineasHorarios'
                || $ultimoSegmento == 'tarifas'): ?>
                <li class="active">
                    <a href="<?= site_url('/autenticacion'); ?>"><span class="fa fa-lock"></span>Iniciar sesión</a>
                </li>
            <?php else: ?>
                <li class="active">
                    <a href="<?= site_url('/visitante'); ?>"><span class="fa fa-lock"></span>Sin sesión</a>
                </li>
            <?php endif; ?>
            
        <?php else: ?>
            <!-- Con session -->
            <!-- <li class="active">   Poner el nombre del cliente marcado por ej -->
                <!-- <a href="#"><span class="fa fa-home"></span> Home</a>
            </li>
            <li>
                <a href="#"><span class="fa fa-user"></span> About</a>
            </li>
            <li>
                <a href="#"><span class="fa fa-sticky-note"></span> Blog</a>
            </li>
            <li>
                <a href="#"><span class="fa fa-cogs"></span> Services</a>
            </li>  -->
            <li class="text-center">
                Sesión abierta por
                <span class="fa fa-user"></span>
                <b><?= session()->get('cliente')->nombre; ?></b>
            </li>
            <hr>


            <!-- Apartado de modificar los datos del cliente -->
            <li>
                <a href="<?= site_url('/modificarCliente'); ?>"><span class="fa fa-edit"></span> Modificar datos personales</a>
            </li>

            <!-- El cierre de la session -->
            <li><!-- luego class de 'a' class="btn btn-danger" -->
                <a href="<?= site_url('/cerrarSession'); ?>"><span class="fa fa-sign-out-alt "></span>Cerrar sesión</a>
            </li>
        <?php endif; ?>


    </ul>

    <div class="footer">
        <!-- <p>
            Copyright &copy;<script>
                document.write(new Date().getFullYear());
            </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
        </p> -->
    </div>
</nav>