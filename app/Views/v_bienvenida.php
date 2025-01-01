<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenidos</title>
        <link rel="stylesheet" href="<?= base_url('css/styleBienvenida.css'); ?>">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <h1 class="display-4">Bienvenido de nuevo <?= session()->get('cliente')->nombre; ?></h1>
                    <p class="lead">Your trusted partner for convenient and reliable bus transportation.</p>
                </div>
            </div>
        </div>



        <div id="divPrin">
            <h1>Bienvenido de nuevo, <?= session()->get('cliente')->nombre; ?> </h1>
            AQUI luego pongo los servicios que tendra el cliente con igual fotos descriptivas en formato cartas o algo asi ... 'los servicios q ofrece la pagina al cliente'
            y si es un Admin pues tendra otras cosas destintas pero seria el mismo concepto 
            y claro voy a arreglar el css tambn 
            Y si es un visitante sin session otras cosas tmb

        </div>


        
    </body>
</html>

