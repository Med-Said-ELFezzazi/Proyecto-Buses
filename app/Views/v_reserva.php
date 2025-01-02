<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Reserva tu Viaje</h3>
                    </div>
                    <div class="card-body">
                        <?= form_open('', ['method' => 'post'])?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Ida</label>
                                <?php
                                    $fecha_actual = date('Y-m-d');
                                    echo form_input([
                                        'type' => 'date',
                                        'name' => 'fecha_ida',
                                        'class' => 'form-control',
                                        'value' => $fecha_actual,
                                        'min' => $fecha_actual
                                    ]);
                                ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Vuelta</label>
                                <?php
                                    echo form_input([
                                        'type' => 'date',
                                        'id' => 'fecha_vuelta',
                                        'name' => 'fecha_vuelta',
                                        'class' => 'form-control',
                                        'value' => $fecha_actual,
                                        'min' => $fecha_actual
                                    ]);
                                ?>
                                <div class="form-check mt-2">
                                    <?php
                                    // checkbox por defecto checkeado
                                        echo form_input([
                                            'type' => 'checkbox',
                                            'name' => 'soloIda',
                                            'id' => 'soloIda',
                                            'class' => 'form-check-input',
                                            'checked' => 'checked'
                                        ]);                                                
                                    ?>
                                    <label class="form-check-label" >Solo ida</label>
                                </div>
                            </div>
                        </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Origen</label>
                                    <?php 
                                        echo form_dropdown('ciudad_origen', $ciudadesOrg, null, [
                                                'class' => 'form-select'
                                            ]);                                 
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Destino</label>
                                    <?php 
                                        echo form_dropdown('ciudad_destino', $ciudadesDes, null, [
                                                'class' => 'form-select'
                                            ]);                                 
                                    ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nº billetes</label>
                                    <?php
                                        echo form_input([
                                            'type' => 'number',
                                            'name' => 'billetes',
                                            'class' => 'form-control',
                                            'min' => '1',
                                            'value' => '1'
                                        ]);
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Número de Asiento</label>
                                    <?php
                                    echo form_input([
                                        'type' => 'number',
                                        'name' => 'asiento',
                                        'id' => 'asiento',
                                        'class' => 'form-control',
                                        'min' => '1',
                                        'value' => '1'
                                    ]);
                                    ?>
                                    <div class="form-check mt-2">
                                        <?php
                                            echo form_input([
                                                'type' => 'checkbox',
                                                'name' => 'asientoAleatorio',
                                                'class' => 'form-check-input',
                                                'value' => '0'
                                            ]);                                                
                                        ?>
                                        <label class="form-check-label" >Asignar asiento aleatorio</label>
                                    </div>
                                </div>
                            </div>
                            <?php
                                echo form_input([
                                    'type' => 'submit',
                                    'name' => 'verServicios',
                                    'value' => 'Ver Servicios',
                                    'class' => 'btn btn-primary'
                                ]);
                            ?>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Al hacer click sobre ver servicios -->
    <?php
        if (isset($_POST['verServicios'])) {
            echo "clicked";

        }
    
    
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('/js/reservas.js'); ?>"></script>
</body>
</html>