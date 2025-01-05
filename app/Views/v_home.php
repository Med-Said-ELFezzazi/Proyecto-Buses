<?= $this->extend("plantillas/layout2zonas"); ?>

<?= $this->section("principal"); ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Home</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        </head>
        <body>
            <?php 
                if ((isset($ciudadesOrg) && isset($ciudadesDes)) ||
                     isset($servicios) || isset($msgError)) {
                    echo view('v_reserva');
                } else if (isset($compraOk) && isset($emailOk)) {
                    echo view('v_compra');   
                } else if (session()->get('admin')) {
                    echo view('v_bienvenida');
                } else {
                    echo view('v_bienvenida');
                }
            ?>            

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>                                                                                <!--Guardando tab activo en localstorage 'NO VA' -->
        </body>
    </html>

<?= $this->endSection(); ?>