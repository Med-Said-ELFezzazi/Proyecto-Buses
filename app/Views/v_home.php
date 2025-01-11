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
            <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
        </head>
        <body>
            <?php 
                if ((isset($ciudadesOrg) && isset($ciudadesDes)) ||
                    isset($servicios) || isset($msgError)) {
                    echo view('v_reserva');
                } else if (isset($compraOk) && isset($emailOk)) {
                    echo view('v_compra');
                } else if (isset($datosBuses)) {
                    echo view('v_buses');
                } else if (isset($datosAverias) || isset($datosFiltrados)) {
                    echo view('v_averias');
                } else if (isset($averia)) {
                    echo view('v_modAveria');
                } else if (isset($matriculas)) {
                    echo view('v_altaAveria');
                } else if (isset($datosRutas) || isset($datosFiltradosRutas)){
                    echo view('v_rutas');
                } else if (isset($rutaAmodificar)) {
                    echo view('v_modRuta');
                } else if (isset($matriculasPaRutas)) {
                    echo view('v_altaRuta');
                } else if(isset($gza)){
                    echo view('v_modRuta');
                }
                else if (isset($tsting)) {
                    echo view('vistaTemp');
                
                
                } else if (isset($opin)) {      // exam
                    echo view('v_opinion');

                }
                 else if (isset($busMod)) {
                    echo view('v_modBus');
                 }
                
                else {
                    echo view('v_bienvenida');  // Aqui va logica de admin en la vista
                }

       

            ?>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>                                                                                <!--Guardando tab activo en localstorage 'NO VA' -->
        </body>
    </html>

<?= $this->endSection(); ?>
































<!-- 


$views = [
                    ['condition' => (isset($ciudadesOrg) && isset($ciudadesDes)) || isset($servicios) || isset($msgError), 'view' => 'v_reserva'],
                    ['condition' => isset($compraOk) && isset($emailOk), 'view' => 'v_compra'],
                    ['condition' => isset($datosBuses), 'view' => 'v_buses'],
                    ['condition' => isset($datosAverias) || isset($datosFiltrados), 'view' => 'v_averias'],
                    ['condition' => isset($averia), 'view' => 'v_modAveria'],
                    ['condition' => isset($matriculas), 'view' => 'v_altaAveria'],
                    ['condition' => isset($datosRutas) || isset($datosFiltradosRutas), 'view' => 'v_rutas'],
                    ['condition' => isset($rutaAmodificar), 'view' => 'v_modRuta'],
                    ['condition' => isset($matriculasPaRutas), 'view' => 'v_altaRuta'],
                    ['condition' => isset($gza), 'view' => 'v_modRuta'],
                    ['condition' => isset($tsting), 'view' => 'vistaTemp'],
                ];

                $viewFound = false;
                foreach ($views as $view) {
                    if ($view['condition']) {
                        echo view($view['view']);
                        $viewFound = true;
                        break;
                    }
                }

                if (!$viewFound) {
                    echo view('v_bienvenida');  // Aqui va logica de admin en la vista
                } -->