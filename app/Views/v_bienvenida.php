<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenidos</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <h1 class="display-6">Bienvenido de nuevo <b style="color: blue;">'<?= session()->get('cliente')->nombre; ?>'</b></h1>
                    <!-- <p class="lead">Tu compañero de confianza para un transporte cómodo y seguro.</p> -->
                </div>
            </div>


            <div class="row g-4">
                <!-- Reserva de Billetes -->
                <div class="col-md-4">
                    <div class="card h-100">                       
                        <img src="<?= base_url('/images/reservaOnline.png')?>" class="card-img-top" style="height: 150px;">
                        <div class="card-body">
                            <h3 class="card-title">Reserva de Billetes</h3>
                            <p class="card-text">
                                Reserva tus billetes de manera fácil/rápida
                            </p>
                            <a href="<?= site_url('/reserva'); ?>" class="btn btn-primary">Reservar Ahora</a>
                        </div>
                    </div>
                </div>

                <!-- Consulta de Horarios -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?= base_url('/images/rutas.png')?>" class="card-img-top" style="height: 150px;">
                        <div class="card-body">
                            <h3 class="card-title">Horarios y Rutas</h3>
                            <p class="card-text">
                                Accede a toda la información de viajes
                            </p>
                            <a href="<?= site_url('/lineasHorarios'); ?>" class="btn btn-primary">Ver Horarios</a>
                        </div>
                    </div>
                </div>

                <!-- Tarifas -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?= base_url('/images/precio.png')?>" class="card-img-top" style="height: 150px;">
                        <div class="card-body">
                            <h3 class="card-title">Tarifas</h3>
                            <p class="card-text">
                                Consulta las tarifas de todas la lineas
                            </p>
                            <a href="<?= site_url('/tarifas'); ?>" class="btn btn-primary">Consultar Tarifas</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    </body>
</html>