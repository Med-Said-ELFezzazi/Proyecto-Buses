 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Ruta</title>
 </head>
 <body>
 <h1 class="text-center">Modificar datos averia</h1>

     <!-- Msj erro/confirmación -->
     <?php
        if (isset($msgInfoRuta)) {
            echo '<div class="alert alert-success text-center" role="alert">';
                echo $msgInfoRuta;
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
            echo '</div>';

        }
        if (isset($msgErrorRuta)) {
            echo '<div class="alert alert-danger text-center" role="alert">';
                echo $msgErrorRuta;
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
            echo '</div>';
            $MatriculaSel = '0';
            $cOrigen = '';
            $cDestino = '';
            $horaSalida = '';
            $horaLlegada = '';
            $fecha = '';
            $tarifa = '';

        }

        // Repoblación de campos en caso de error en caso inserción existosa limpiar campos
        if (isset($msgErrorRuta)) {
            $MatriculaSel = $_POST['MatriculaSel'] ?? '0';
            $cOrigen = $_POST['cOrigen'] ?? '';
            $cDestino = $_POST['cDestino'] ?? '';
            $horaSalida = $_POST['horaSalida'] ?? '';
            $horaLlegada = $_POST['horaLlegada'] ?? '';
            $fecha = $_POST['fecha'] ?? '';
            $tarifa = $_POST['tarifa'] ?? '';
        } else {
            $MatriculaSel = '0';
            $cOrigen = '';
            $cDestino = '';
            $horaSalida = '';
            $horaLlegada = '';
            $fecha = '';
            $tarifa = '';
        }
     ?>

    <div>
        <?= form_open(current_url(), ['method' => 'post']); ?>
        <div class="form-group">
            <?php
                echo form_label('Matrícula', 'matricula', ['class' => 'form-label']); 
                $opcionesMatriculas = [
                    '0' => 'Seleccione matrícula'
                ];
                foreach ($matriculasModRuta as $matricula) {
                    $opcionesMatriculas[$matricula->matricula] = $matricula->matricula;
                }
                echo form_dropdown('MatriculaSel', $opcionesMatriculas, $rutaAmodificar->matricula, [
                    'class' => 'form-control'
                ]);
            ?>
        </div>

        <div class="form-group">
            <?php
                echo form_label('Ciudad Origen', 'cOrigen', ['class' => 'form-label']); 
                echo form_input(['name' => 'cOrigen',
                                'type' => 'text',
                                'value' => $rutaAmodificar->ciudad_origin,
                                'class' => 'form-control',
                                ]);
            ?>
        </div>
        <div class="form-group">
            <?php
                echo form_label('Ciudad Destino', 'cDestino', ['class' => 'form-label']); 
                echo form_input(['name' => 'cDestino',
                                'type' => 'text',
                                'value' => $rutaAmodificar->ciudad_destino,
                                'class' => 'form-control',
                                ]);
            ?>
        </div>

        <div class="form-group">
            <?php 
                echo form_label('Hora de salida', 'horaSalida'); 
                echo form_input(['type' => 'time',
                                'name' => 'horaSalida',
                                'step' => 600,
                                'value' => $rutaAmodificar->hora_salida,
                                'class' => 'form-control']); 
            ?>
        </div>

        <div class="form-group">
            <?php 
                echo form_label('Hora de llegada', 'horaLlegada'); 
                echo form_input(['type' => 'time',
                                'name' => 'horaLlegada',
                                'step' => 600,
                                'value' => $rutaAmodificar->hora_llegada,
                                'class' => 'form-control']); 
            ?>
        </div>
        
        <div class="form-group">
            <?php
                echo form_label('Fecha de viaje', 'fecha', ['class' => 'form-label']); 
                echo form_input(['name' => 'fecha',
                                'type' => 'date',
                                'value' => $rutaAmodificar->fecha,
                                'class' => 'form-control',
                                ]);
            ?>
        </div>
        

        <div class="form-group">
            <?php 
                echo form_label('Tarifa actual', 'tarifa');
                echo form_input(['type' => 'number',
                                'name' => 'tarifa',
                                'value' => $rutaAmodificar->tarifa,
                                'class' => 'form-control']); 
            ?>
        </div>

                
        <div class="text-center">
            <?php 
                echo form_input(['name' => 'actualizarRuta',
                                'type' => 'submit',
                                'value' => 'Actualizar Ruta',
                                'class' => 'btn btn-primary']); 
            ?>
            <a href="<?= site_url('/admin/rutas'); ?>" class="btn btn-secondary">Volver</a>
        </div>
    </div>
    <?= form_close(); ?>

        
 </body>
 </html>