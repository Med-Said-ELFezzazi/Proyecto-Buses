<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar bus</title>
 </head>
 <body>
 <h1 class="text-center">Modificar datos Bus</h1>

     <!-- Msj erro/confirmación -->
    <?php
       if (isset($msgInfoModBus)) {
          echo '<div class="alert alert-success text-center" role="alert">';
             echo $msgInfoModBus;
             echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
             echo '</button>';
          echo '</div>';

       }
       if (isset($msgErrModBus)) {
          echo '<div class="alert alert-danger text-center" role="alert">';
             echo $msgErrModBus;
             echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
             echo '</button>';
          echo '</div>';
       }

       // Repoblación de campos en caso de error
       $capacidad = $_POST['capacidad'] ?? $busMod->capacidad;
       $modelo = $_POST['modelo'] ?? $busMod->modelo;
    ?>

    <?= form_open(current_url(), ['method' => 'post', 'enctype' => 'multipart/form-data']); ?>

    <div class="card mb-3" style="border-width: 2px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <?php if($busMod->imagen == 'sinImg.png'): ?>
                    <div class="text-center">
                        <b>Bus sin imagen</b>
                    </div>
                <?php endif; ?>
                <img src="<?= base_url('/images/buses/' . $busMod->imagen); ?>" class="card-img" alt="Imagen del bus">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="form-group">
                        <?php
                            echo form_label('Subir nueva imagen', 'imagen', ['class' => 'form-label']);
                            echo form_upload([
                                'name' => 'imagen',
                                'class' => 'form-control',
                                'accept' => '.jpg,.jpeg,.png,.gif'
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="form-group">
            <?php
                echo form_label('Matrícula', 'matricula', ['class' => 'form-label']);
                echo form_input(['name' => 'matricula',
                'type' => 'text',
                'value' => $busMod->matricula,
                'class' => 'form-control',
                'disabled' => 'disabled'
                ]);
            ?>
        </div>

        <div class="form-group">
            <?php 
                echo form_label('Capacidad', 'capacidad'); 
                echo form_input(['type' => 'number',
                                'name' => 'capacidad',
                                'value' => $capacidad,
                                'min' => 5,
                                'class' => 'form-control']); 
            ?>
        </div>

        <div class="form-group">
            <?php 
                echo form_label('Modelo', 'modelo'); 
                echo form_input(['type' => 'text',
                                'name' => 'modelo',
                                'value' => $modelo,
                                'class' => 'form-control']); 
            ?>
        </div>

                
        <div class="text-center">
            <?php 
                echo form_input(['name' => 'actualizarBus',
                                'type' => 'submit',
                                'value' => 'Actualizar Bus',
                                'class' => 'btn btn-primary']); 
            ?>
            <a href="<?= site_url('/admin/buses'); ?>" class="btn btn-secondary">Volver</a>
        </div>
    </div>
    <?= form_close(); ?>

        
 </body>
 </html>