<div class="row">
    <!-- Filtros -->
    <h1 class="text-center">Lista de rutas</h1>
    <!-- Botón para cargar el formulario de añadir ruta -->
    <div class="col-12 mb-2">
        <?= form_open(current_url(), ['method' => 'post']); ?>
            <?= form_hidden('mostrarForm', '1'); ?>
            <?= form_input([
                'type' => 'submit',
                'name' => 'mostrarForm',
                'value' => 'Añadir Ruta',
                'class' => 'btn bg-primary float-left',
                'style' => 'color: white;'
            ]); ?>
        <?= form_close(); ?>
    </div>

    <!-- msg info de eliminacion -->
    <?php
        if (isset($eliminacionRuta)) {
            if ($eliminacionRuta) {
                echo '<div class="alert alert-success text-center" role="alert">';
                    echo 'La ruta ha sido eliminada correctamente';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger text-center" role="alert">';
                    echo 'Error al eliminar la avería de la BD!';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                echo '</div>';
            }
        }
    ?>


    <div class="col-md-3" style="background-color:rgb(13, 151, 244);">
        <div class="boxHorariosHome MT20">
            <div class="contCampos" style="padding: 5px;">
                <h2 style="color: white;" class="text-center">Filtros</h2>
                <hr>
                <?= form_open(current_url(), ['method' => 'post']); ?>
                <p>
                    <b style="color: white;">Matrícula </b>
                    <?php 
                        $matriculaSel = $_POST['matriculaRuta'] ?? '';    // Recuperar datos si hay
                        echo form_input([
                            'type' => 'text',
                            'name' => 'matriculaRuta',
                            'value' => $matriculaSel,
                            'placeholder' => 'Inserta la matrícula'
                        ]);
                    ?>
                </p>
                <p>
                    <b style="color: white;">Ciudades </b>
                    <br>
                    <?php
                        $ciudadesOptions = [
                            '0' => 'Seleccione ciudad',
                        ];
                        foreach ($todasCiudades as $ciudad) {
                            $ciudadesOptions[$ciudad->ciudad_origin] = $ciudad->ciudad_origin;
                        }
                        $CiudadSel = $_POST['origenSel'] ?? '0';
                        echo form_dropdown('CiudadSel', $ciudadesOptions, $CiudadSel, [
                            'id' => 'CiudadSel',
                            'class' => 'select',
                        ]);
                    ?>
                </p>
                <p>
                    <b style="color: white;">Horario </b>
                    <br>
                    <?php
                        $horaSalidaSel = $_POST['horaSalida'] ?? '';
                        echo "<b style='color: white;'>Salida</b>";
                        echo form_input([
                            'type' => 'time',
                            'name' => 'horaSalida',
                            'value' => $horaSalidaSel,
                            'step' => '600' // Incrementos de 10 minutos (600 segundos)
                        ]);
                    ?>
                    <br>
                    <?php echo "<b style='color: white;'>Llegada</b>"; ?>
                    <?php
                        $horaLlegadaSel = $_POST['horaLlegada'] ?? '';
                        echo form_input([
                            'type' => 'time',
                            'name' => 'horaLlegada',
                            'value' => $horaLlegadaSel,
                            'step' => '600' // Incrementos de 10 minutos (600 segundos)
                        ]);
                    ?>
                </p>
                <p>
                    <b style="color: white;">Fecha </b>
                    <br>
                    <?php
                        $fechaSel = $_POST['fechaRuta'] ?? '';
                        echo form_input([
                            'type' => 'date',
                            'name' => 'fechaRuta',
                            'value' => $fechaSel
                        ]);
                    ?>
                </p>
                <p>
                    <b style="color: white;">tarifa </b>
                    <br>
                    <?php
                        $tarifaMinSel = $_POST['tarifaMinRuta'] ?? '';
                        $tarifaMaxSel = $_POST['tarifaMaxRuta'] ?? '';
                        echo form_input([
                            'type' => 'number',
                            'name' => 'tarifaMinRuta',
                            'min' => '0',
                            'value' => $tarifaMinSel,
                            'placeholder' => 'Mín',
                            'style' => 'display: inline-block; width: 45%;'
                        ]);
                        echo '<b style="color: white;"> - </b>';
                        echo form_input([
                            'type' => 'number',
                            'name' => 'tarifaMaxRuta',
                            'min' => '0',
                            'value' => $tarifaMaxSel,
                            'placeholder' => 'Máx',
                            'style' => 'display: inline-block; width: 45%;'
                        ]);
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
                    <th>C.Origen</th>
                    <th>C.Destino</th>
                    <th>H.Salida</th>
                    <th>H.Llegada</th>
                    <th>Fecha</th>
                    <th>Tarifa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if (!isset($datosFiltradosRutas)) {
                        foreach($datosRutas as $ruta) {
                            echo '<tr>';
                                echo '<td>';
                                    echo $ruta->id_ruta;
                                echo '</td>';
                                echo '<td>';
                                    echo $ruta->matricula;
                                echo '</td>';
                                echo '<td>';
                                    echo $ruta->ciudad_origin;
                                echo '</td>';
                                echo '<td>';
                                    echo $ruta->ciudad_destino;
                                echo '</td>';
                                echo '<td>';
                                    echo date('H:i', strtotime($ruta->hora_salida));
                                echo '</td>';
                                echo '<td>';
                                    echo date('H:i', strtotime($ruta->hora_llegada));
                                echo '</td>';
                                echo '<td>';
                                    echo date('d/m/Y', strtotime($ruta->fecha));
                                echo '</td>';
                                echo '<td>';
                                    echo $ruta->tarifa;
                                echo '</td>';
                                echo '<td>';
                                    echo '<a href="' . site_url("/admin/rutas/modificar/" . $ruta->id_ruta) . '" 
                                    class="btn btn-warning">Editar</a>';
                                    echo '&ensp;';
                                    echo form_open(current_url(), ['method' => 'post']);
                                        echo form_hidden('id_rutaBorrar', $ruta->id_ruta);
                                        echo form_input([
                                            'type' => 'submit',
                                            'value' => 'Eliminar',
                                            'class' => 'btn btn-danger']);
                                    echo form_close();
                                echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        // Mostrar datos filtrados
                        foreach($datosFiltradosRutas as $ruta) {
                            echo '<tr>';
                                echo '<td>';
                                    echo $ruta->id_ruta;
                                echo '</td>';
                                echo '<td>';
                                    echo $ruta->matricula;
                                echo '</td>';
                                echo '<td>';
                                    echo $ruta->ciudad_origin;
                                echo '</td>';
                                echo '<td>';
                                    echo $ruta->ciudad_destino;
                                echo '</td>';
                                echo '<td>';
                                    echo date('H:i', strtotime($ruta->hora_salida));
                                echo '</td>';
                                echo '<td>';
                                    echo date('H:i', strtotime($ruta->hora_llegada));
                                echo '</td>';
                                echo '<td>';
                                    echo date('d/m/Y', strtotime($ruta->fecha));
                                echo '</td>';
                                echo '<td>';
                                    echo $ruta->tarifa;
                                echo '</td>';
                                echo '<td>';
                                    echo '<a href="' . site_url("/admin/rutas/modificar/" . $ruta->id_ruta) . '" 
                                    class="btn btn-warning">Editar</a>';
                                    echo '&ensp;';
                                    echo form_open(current_url(), ['method' => 'post']);
                                    echo form_hidden('id_rutaBorrar', $ruta->id_ruta);
                                    echo form_input([
                                        'type' => 'submit',
                                        'value' => 'Eliminar',
                                        'class' => 'btn btn-danger']);
                                echo form_close();
                                echo '</td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>