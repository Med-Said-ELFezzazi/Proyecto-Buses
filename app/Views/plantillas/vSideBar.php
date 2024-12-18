<nav id="sidebar" class="active">
    <h1><a href="index.html" class="logo">BUS</a></h1>
    <ul class="list-unstyled components mb-5">
        <!-- Sin session -->
        <?php if (!session()->get('dniCliente')):?>
            <li class="active">
                <a href="<?= site_url('/visitante'); ?>"><span class="fa fa-lock"></span>Sin sesión</a>
            </li>
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

            <li>
                <b>Sesión abierta por</b>
            </li>
            <li>
                <b>Sesión abierta por</b>
            </li>
    
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