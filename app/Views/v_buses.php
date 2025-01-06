<?php 
    // msj de error
    if (isset($msgErrorMatricula)){
        echo '<div class="alert alert-danger" role="alert">
                    ' . $msgErrorBus . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close
                <span aria-hidden="true">&times;</span></button>
            </div>';
    }

    // msg de confirmación
    if (isset($msgMatriExito)){
        echo '<div class="alert alert-success" role="alert">
                ' . $msgMatriExito . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>';
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buses</title>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            // Función cambia entre la vista de listar infos y añadir nuevo bus
            function cambiarVista() {
                // Obtener el texto del button Añadir nuevo bus
                let btnAniadirBus = document.getElementById('btnAniadirBus');
                let textoBtn = btnAniadirBus.textContent;

                if (textoBtn == 'Añadir nuevo bus') {
                    // Cambio del texto titulo
                    document.getElementById('titulo-vista').textContent = 'Añadir nuevo autobús';
                    // Cambio el texto del button
                    btnAniadirBus.textContent = 'Listar datos';
                    // Cambio la vista al form
                    document.getElementById('busInfo').classList.add('d-none');
                    document.getElementById('nuevoBusForm').classList.remove('d-none');
                } else {
                    // Cambio del texto titulo
                    document.getElementById('titulo-vista').textContent = 'Información de buses';
                    // Cambio el texto del button
                    btnAniadirBus.textContent = 'Añadir nuevo bus';
                    // Cambio la vista a la info
                    document.getElementById('nuevoBusForm').classList.add('d-none');
                    document.getElementById('busInfo').classList.remove('d-none');
                }
            }

            let btnAniadirBus = document.getElementById('btnAniadirBus');
            btnAniadirBus.addEventListener('click', cambiarVista);
        });

    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center" id="titulo-vista">Información de buses</h1>
        
        <!-- Button para pasar a añadir un bus nuevo -->
        <button class="btn btn-primary mb-3" id="btnAniadirBus">Añadir nuevo bus</button>

        <!-- Tabla de infos de buses -->
        <div id="busInfo">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Matricula</th>
                        <th>Capacidad</th>
                        <th>Modelo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datosBuses as $bus): ?>
                        <tr>
                            <td><?php 
                                    if ($bus->imagen == '') {
                                        $rutaImg = base_url('images/buses/sinImg.png');
                                    } else {
                                        $rutaImg = base_url('images/buses/'. $bus->imagen . '');
                                    }
                                ?>
                                <img src="<?= $rutaImg ?>" alt="Bus Image" class="img-fluid" style="width: 100px; height: auto;">
                            </td>
                            <td><?= $bus->matricula; ?></td>
                            <td><?= $bus->capacidad; ?></td>
                            <td><?= $bus->modelo; ?></td>
                            <td>
                                <a href="edit.php?id=<?= '$bus[id]'; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="delete.php?id=<?= '$bus[id]'; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Estás seguro de que quieres eliminar este autobús?')">Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Formulario para añadir nuevo bus -->
        <div id="nuevoBusForm" class="d-none">
            <h3 class="text-center text-success">Rellena los siguientes datos</h3>
            <!-- <= form_open(site_url('/admin/buses'), ['method' => 'post'])?> -->
            <?= form_open(site_url('/admin/buses'), ['method' => 'post', 'enctype' => 'multipart/form-data']) ?>
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <?php 
                        echo form_upload(['name' => 'imagen',
                                        'class' => 'form-control',
                                        'accept' => '.jpg,.jpeg,.png,.gif'
                                    ]);
                                    // El accept solo da sugerencias en el html
                    ?>
                </div>
                <div class="form-group">
                    <label for="matricula">Matricula</label>
                    <?php 
                        echo form_input(['type' => 'text',
                                        'name' => 'matricula', 
                                        'id' => 'matricula', 
                                        'class' => 'form-control', 
                                        'required' => 'required']);
                    ?>
                </div>
                <div class="form-group">
                    <label for="capacidad">Capacidad</label>
                    <?php 
                        echo form_input(['type' => 'number',
                                        'name' => 'capacidad', 
                                        'id' => 'capacidad', 
                                        'class' => 'form-control',
                                        'min' => 5,
                                        'required' => 'required']);
                    ?>
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <?php 
                        echo form_input(['type' => 'text',
                                        'name' => 'modelo', 
                                        'id' => 'modelo', 
                                        'class' => 'form-control', 
                                        'required' => 'required']);
                    ?>
                </div>
                <?= form_input(['type' => 'submit',
                                'name' => 'aniadirBus',
                                'value' => 'Guardar datos',
                                'class' => 'btn btn-success'])?>

            <?= form_close(); ?>
        </div>
    </div>
</body>
</html>
