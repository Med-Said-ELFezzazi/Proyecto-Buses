<?php
// msj de error 'Añadir'
if (isset($_POST['aniadirBus'])) {
    if (isset($msgErrorBus)) {
        echo '<div class="alert alert-danger text-center" role="alert">
                        ' . $msgErrorBus . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                    <span aria-hidden="true">&times;</span></button>
                </div>';
    }

    // msg de confirmación 'Añadir'
    if (isset($msgMatriExito)) {
        echo '<div class="alert alert-success text-center" role="alert">
                    ' . $msgMatriExito . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buses</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

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


            // Editar bus
            /*document.querySelectorAll('.btn-editar').forEach(function (btnEditar) {
                btnEditar.addEventListener('click', function () {
                    const fila = this.closest('tr'); // Fila actual
                    const form = fila.querySelector('.bus-form'); // Formulario de la fila
                    const editando = fila.classList.contains('editando'); // Verificar modo edición

                    // Al hacer clic en Editar
                    if (!editando) {
                        // Prevenir el envío del formulario en modo edición
                        event.preventDefault();
                        fila.querySelectorAll('[data-field]').forEach(function (campo) {
                            const nomInput = campo.getAttribute('data-field');
                            const tipo = nomInput === 'modelo' ? 'text' : 'number';
                            const value = campo.textContent.trim();

                            // Crear un nuevo input y reemplazar el contenido
                            const input = document.createElement('input');
                            input.type = tipo;
                            input.name = nomInput;
                            input.value = value;
                            input.className = 'form-control';
                            campo.innerHTML = '';
                            campo.appendChild(input);
                        });

                        // Cambiar el texto del btn a "Guardar"
                        this.textContent = 'Guardar';
                        this.type = 'submit'; // Cambia el tipo a submit para enviar el formulario
                        this.name = 'modificarBus'; // Asegúrate de que tenga el atributo name
                        fila.classList.add('editando');
                    } else { 
                        // Cambiar de vuelta a modo Editar
                        this.textContent = 'Editar';
                        this.type = 'button'; // Vuelve a ser un btn normal
                        this.name = ''; // Elimina el atributo name
                        fila.classList.remove('editando');
                        // enviar form
                        form.submit();
                    }
                });
            });*/


    });


    </script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center" id="titulo-vista">Información de buses</h1>

        <!-- Button para pasar a añadir un bus nuevo -->
        <button class="btn btn-primary mb-3" id="btnAniadirBus">Añadir nuevo bus</button>

        <!-- msj de error/confirmacion al borrar y al modificar -->
        <?php
            // Modificar
            if (isset($_POST['modificarBus'])) {
                if (isset($_POST['msgInfoModBus'])) {
                    echo '<div class="alert alert-success" role="alert">';
                        echo $msgInfoModBus;
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>';
                    echo '</div>';
                }
    
                if (isset($_POST['msgErrModBus'])) {
                    echo '<div class="alert alert-danger" role="alert">';
                        echo $msgErrModBus;
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>';
                    echo '</div>';
                }
            }

            // Borrar
            if (isset($_POST['borrarBus'])) {
                if (isset($msgExitoEliBus)) {
                    // Eliminacion correcta
                    echo '<div class="alert alert-success" role="alert">';
                        echo $msgExitoEliBus;
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>';
                    echo '</div>';
                }
                if (isset($msgErrorEliBus)) {
                    // Eliminacion incorrecta
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $msgErrorEliBus;
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>';
                    echo '</div>';
                }
            }

        ?>

        <!-- Tabla de infos de buses -->
        <div id="busInfo">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Matricula</th>
                        <th>Capacidad</th>
                        <th>Modelo</th>
                        <th colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datosBuses as $bus): ?>
                        <tr data-matricula="<?= $bus->matricula; ?>">
                            <td>
                                <?php $rutaImg = base_url('images/buses/' . $bus->imagen); ?>
                                <img src="<?= $rutaImg ?>" alt="Bus Image" class="img-fluid" style="width: 120px; height: auto;">
                            </td>
                            <?= form_open(current_url(), ['method' => 'post', 'class' => 'bus-form']) ?>
                            <td><?= $bus->matricula; ?></td>
                            <td data-field="capacidad"><?= $bus->capacidad; ?></td>
                            <td data-field="modelo"><?= $bus->modelo; ?></td>
                            <td>
                                <!-- <button type="button" class="btn btn-warning btn-sm btn-editar" name="modificarBus">Editar</button> -->
                                <!-- Borrar y modificar-->
                                <?= form_hidden('capacidad', $bus->capacidad); ?>
                                <?= form_hidden('modelo', $bus->modelo); ?>
                                <?= form_hidden('matricula', $bus->matricula); ?>
                        
                                <a href="<?php echo current_url() . '/mod/' . $bus->matricula; ?>" class="btn btn-warning">Editar</a>                               
                            </td>
                            <td>
                                <?= form_input([
                                    'name' => 'borrarBus',
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'value' => 'Borrar'
                                ]); ?>
                            </td>
                            <?= form_close(); ?>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

        <!-- Formulario para añadir nuevo bus -->
        <div id="nuevoBusForm" class="d-none">
            <h3 class="text-center text-success">Rellena los siguientes datos</h3>
            <?= form_open(site_url('/admin/buses'), ['method' => 'post', 'enctype' => 'multipart/form-data']) ?>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <?php
                echo form_upload([
                    'name' => 'imagen',
                    'class' => 'form-control',
                    'accept' => '.jpg,.jpeg,.png,.gif'
                ]);
                // El accept solo da sugerencias en el html
                ?>
            </div>
            <div class="form-group">
                <label for="matricula">Matricula</label>
                <?php
                echo form_input([
                    'type' => 'text',
                    'name' => 'matricula',
                    'id' => 'matricula',
                    'class' => 'form-control',
                    'required' => 'required'
                ]);
                ?>
            </div>
            <div class="form-group">
                <label for="capacidad">Capacidad</label>
                <?php
                echo form_input([
                    'type' => 'number',
                    'name' => 'capacidad',
                    'id' => 'capacidad',
                    'class' => 'form-control',
                    'min' => 5,
                    'required' => 'required'
                ]);
                ?>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <?php
                echo form_input([
                    'type' => 'text',
                    'name' => 'modelo',
                    'id' => 'modelo',
                    'class' => 'form-control',
                    'required' => 'required'
                ]);
                ?>
            </div>
            <?= form_input([
                'type' => 'submit',
                'name' => 'aniadirBus',
                'value' => 'Guardar datos',
                'class' => 'btn btn-success'
            ]) ?>

            <?= form_close(); ?>
        </div>
    </div>
</body>

</html>