<div class="row">
    <!-- Filtros -->
    <div class="col-md-3" style="background-color:rgb(13, 151, 244);">
        <div class="boxHorariosHome MT20">
            <div class="contCampos" style="padding: 5px;">
                <h2 style="color: white;" class="text-center">Filtros</h2>
                <hr>
                <?= form_open(current_url(), ['method' => 'post']); ?>
                <p>
                    <b style="color: white;">Matrícula </b>
                    <?php 
                        $matriculaSel = $_POST['matriculaAveria'] ?? '';    // Recuperar datos si hay
                        echo form_input([
                            'type' => 'text',
                            'name' => 'matriculaAveria',
                            'value' => $matriculaSel,
                            'placeholder' => 'Inserta la matrícula'
                        ]);
                    ?>
                </p>
                <p>
                    <b style="color: white;">Fecha </b>
                    <br>
                    <?php
                        $fechaSel = $_POST['fechaAveria'] ?? '';
                        echo form_input([
                            'type' => 'date',
                            'name' => 'fechaAveria',
                            'value' => $fechaSel
                        ]);
                    ?>
                </p>
                <p>
                    <b style="color: white;">Coste </b>
                    <br>
                    <?php
                        $costeMinSel = $_POST['costeMinAveria'] ?? '';
                        $costeMaxSel = $_POST['costeMaxAveria'] ?? '';
                        echo form_input([
                            'type' => 'number',
                            'name' => 'costeMinAveria',
                            'min' => '0',
                            'value' => $costeMinSel,
                            'placeholder' => 'Mín',
                            'style' => 'display: inline-block; width: 45%;'
                        ]);
                        echo '<b style="color: white;"> - </b>';
                        echo form_input([
                            'type' => 'number',
                            'name' => 'costeMaxAveria',
                            'min' => '0',
                            'value' => $costeMaxSel,
                            'placeholder' => 'Máx',
                            'style' => 'display: inline-block; width: 45%;'
                        ]);
                    ?>
                </p>
                <p>
                    <b style="color: white;">Estado de reparación </b>
                    <br>
                    <?php
                        $estadoAveria = $_POST['estadoAveria'] ?? 2;
                        echo form_radio(['name' => 'estadoAveria',
                                        'value' => 1,
                                        'checked' => $estadoAveria == 1]); // Marcado si el valor enviado es 1
                        echo form_label('Reparado', 'reparado', ['style' => 'color: white;']);
                    
                        echo form_radio(['name' => 'estadoAveria',
                                        'value' => 0,
                                        'checked' => $estadoAveria == 0]);
                        echo form_label('Averiado', 'averiado', ['style' => 'color: white;']);

                        echo form_radio(['name' => 'estadoAveria',
                                        'value' => 2,
                                        'checked' => $estadoAveria == 2]);
                        echo form_label('Ambos', 'ambos', ['style' => 'color: white;']);
                    ?>
                </p>
                <div class="text-center">
                    <?php
                        echo form_input([
                            'type' => 'submit',
                            'name' => 'aplicarFiltros',
                            'value' => 'Aplicar'
                        ]);
                    ?>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="col-md-9">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Matrícula</th>
                    <th>Descripción</th>
                    <th>Fecha y hora</th>
                    <th>Coste de reparación</th>
                    <th>Reparada</th>     <!--Coste <= al insertado-->
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Mostrar todos  datos
                    if (!isset($datosFiltrados)) {
                        foreach($datosAverias as $averia) {
                            echo '<tr>';
                                echo '<td>';
                                    echo $averia->id_averia;
                                echo '</td>';
                                echo '<td>';
                                    echo $averia->matricula;
                                echo '</td>';
                                echo '<td>';
                                    echo $averia->descripcion;
                                echo '</td>';
                                echo '<td>';
                                    echo date('d/m/Y H:i', strtotime($averia->fecha));
                                echo '</td>';
                                echo '<td>';
                                    echo $averia->coste . '€';
                                echo '</td>';
                                echo '<td>';
                                    if ($averia->reparada) {
                                        echo 'Sí';
                                    } else {
                                        echo 'No';
                                    }
                                echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        // Mostrar datos filtrados
                        foreach($datosFiltrados as $averia) {
                            echo '<tr>';
                                echo '<td>';
                                    echo $averia->id_averia;
                                echo '</td>';
                                echo '<td>';
                                    echo $averia->matricula;
                                echo '</td>';
                                echo '<td>';
                                    echo $averia->descripcion;
                                echo '</td>';
                                echo '<td>';
                                    echo date('d/m/Y H:i', strtotime($averia->fecha));
                                echo '</td>';;
                                echo '<td>';
                                    echo $averia->coste . '€';
                                echo '</td>';
                                echo '<td>';
                                    if ($averia->reparada) {
                                        echo 'Sí';
                                    } else {
                                        echo 'No';
                                    }
                                echo '</td>';
                            echo '</tr>';
                        }
                    }
                ?>

            </tbody>
        </table>
    </div>
</div>