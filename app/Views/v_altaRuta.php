<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta averia</title>
</head>
<body>
<h1 class="text-center">Añadir nueva Ruta</h1>
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
            $cOrigin = '';
            $cDestino = '';
            // $horaSalida = '';
            // $horaLlegada = '';
            // $fecha = '';
            $tarifa = '';
        }

        // Repoblación de campos en caso de error en caso inserción existosa limpiar campos
        if (isset($msgErrorRuta)) {
            $MatriculaSel = $_POST['MatriculaSel'] ?? '0';
            $cOrigin = $_POST['cOrigin'] ?? '';
            $cDestino = $_POST['cDestino'] ?? '';
            $horaSalida = $_POST['horaSalida'] ?? '';
            $horaLlegada = $_POST['horaLlegada'] ?? '';
            $fecha = $_POST['fecha'] ?? '';
            $tarifa = $_POST['tarifa'] ?? '';
        } else {
            $MatriculaSel = '0';
            $cOrigin = '';
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
                    '0' => 'Seleccione matricula',
                ];
                foreach ($matriculasPaRutas as $matricula) {
                    $opcionesMatriculas[$matricula->matricula] = $matricula->matricula;
                }
                $MatriculaSel = $_POST['MatriculaSel'] ?? '0';
                echo form_dropdown('MatriculaSel', $opcionesMatriculas, $MatriculaSel, [
                                    'class' => 'form-control'
                                ]);    
            ?>
        </div>
        
        <div class="form-group">
            <?php 
                echo form_label('Ciudad origen', 'cOrigin');
                echo form_input(['name' => 'cOrigin',
                                'type' => 'text',
                                'class' => 'form-control',
                                'value' => $cOrigin,
                                'placeHolder' => 'Introduce ciudad de partida']);
            ?>
        </div>

        <div class="form-group">
            <?php 
                echo form_label('Ciudad destino', 'cDestino');
                echo form_input(['name' => 'cDestino',
                                'type' => 'text',
                                'class' => 'form-control',
                                'value' => $cDestino,
                                'placeHolder' => 'Introduce ciudad de destino']);
            ?>
        </div>
        
        <div class="form-group">
            <?php 
                echo form_label('Hora de salida', 'horaSalida'); 
                echo form_input(['type' => 'time',
                                'name' => 'horaSalida',
                                'step' => 600,
                                'value' => $horaSalida,
                                'class' => 'form-control']); 
            ?>
        </div>

        <div class="form-group">
            <?php 
                echo form_label('Hora de llegada', 'horaLlegada'); 
                echo form_input(['type' => 'time',
                                'name' => 'horaLlegada',
                                'step' => 600,
                                'value' => $horaLlegada,
                                'class' => 'form-control']); 
            ?>
        </div>

        <div class="form-group">
            <?php 
                echo form_label('Fecha', 'fecha'); 
                echo form_input(['type' => 'date',
                                'name' => 'fecha',
                                'value' => $fecha,
                                'min' => date('Y-m-d'),
                                'class' => 'form-control']); 
            ?>
        </div>
        
        <div class="form-group">
            <?php 
                echo form_label('Precio de viaje', 'tarifa');
                echo form_input(['type' => 'number',
                                'step' => '0.01',
                                'name' => 'tarifa',
                                'value' => $tarifa,
                                'min' => 0,
                                'class' => 'form-control']); 
            ?>
        </div>
        
        <div class="text-center">
            <?php 
                echo form_input([
                                'name' => 'GuardarRuta',
                                'type' => 'submit',
                                'value' => 'Guardar',
                                'class' => 'btn btn-primary']); 

            ?>
            <a href="<?= site_url('/admin/rutas'); ?>" class="btn btn-secondary">Volver</a>
        </div>
        
        <?php echo form_close(); ?>
    </div>

</body>
</html>