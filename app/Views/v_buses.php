<?php
// msj de error 'Añadir'
if (isset($_POST['aniadirBus'])) {
    if (isset($msgErrorBus)) {
        echo '<div class="alert alert-danger" role="alert">
                        ' . $msgErrorBus . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                    <span aria-hidden="true">&times;</span></button>
                </div>';
    }

    // msg de confirmación 'Añadir'
    if (isset($msgMatriExito)) {
        echo '<div class="alert alert-success" role="alert">
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
        });


        // Modificar 
        /*document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-editar').forEach(function(btnEditar) {
                btnEditar.addEventListener('click', function() {
                    const fila = this.closest('tr'); // Fila actual
                    const editando = fila.classList.contains('editing'); // Comprobar si ya está en modo edición

                    if (!editando) {
                        // Cambiar texto de la fila a inputs
                        fila.querySelectorAll('[data-field]').forEach(function(campo) {
                            const nomInput = campo.getAttribute('data-field');
                            const tipo = nomInput == 'matricula' ? 'text' : 'number';
                            const value = campo.textContent.trim();
                            campo.innerHTML = `<input type="${tipo}" name="${nomInput}" value="${value}" class="form-control">`;
                        });

                        // Cambiar texto del button Editar a Guardar
                        this.textContent = 'Guardar';
                        fila.classList.add('editing');
                    } else {
                        this.textContent = 'Editar';
                        fila.classList.add('editing');
                    }


                    //else {
                        // Enviar los datos modificados al servidor
                        // const formData = new FormData();
                        // fila.querySelectorAll('input').forEach(function(input) {
                        //     formData.append(input.name, input.value);
                        // });

                        // Opcional: incluir datos adicionales como matrícula
                        // formData.append('matricula', fila.getAttribute('data-matricula'));

                        // fetch('ruta_a_tu_script_php', {
                        //         method: 'POST',
                        //         body: formData
                        //     })
                        //     .then(response => response.json())
                        //     .then(data => {
                        //         if (data.success) {
                        //             // Actualizar la fila con los nuevos valores
                        //             fila.querySelectorAll('input').forEach(function(input) {
                        //                 input.parentElement.textContent = input.value;
                        //             });
                        //             // Cambiar botón Guardar a Editar
                        //             btnEditar.textContent = 'Editar';
                        //             fila.classList.remove('editing');
                        //         } else {
                        //             alert('Error al guardar los datos: ' + data.error);
                        //         }
                        //     })
                        //     .catch(error => console.error('Error:', error));
                   // }
                });
            });
        });*/


        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-editar').forEach(function(btnEditar) {
                btnEditar.addEventListener('click', function() {
                    const fila = this.closest('tr'); // Fila actual
                    const editando = fila.classList.contains('editing'); // Comprobar si ya está en modo edición

                    if (!editando) {
                        // Cambiar texto de la fila a inputs
                        fila.querySelectorAll('[data-field]').forEach(function(campo) {
                            const nomInput = campo.getAttribute('data-field');
                            const tipo = nomInput == 'matricula' ? 'text' : 'number';
                            const value = campo.textContent.trim();
                            campo.innerHTML = `<input type="${tipo}" name="${nomInput}" value="${value}" class="form-control">`;
                        });

                        // Cambiar imagen a input file
                        const imgCampo = fila.querySelector('[data-field="imagen"]');
                        if (imgCampo) {
                            const currentImage = imgCampo.querySelector('img').getAttribute('src');
                            imgCampo.innerHTML = `
                        <input type="file" name="imagen" class="form-control">
                        <input type="hidden" name="imagen_actual" value="${currentImage}">
                    `;
                        }

                        // Cambiar texto del botón Editar a Guardar
                        this.textContent = 'Guardar';
                        fila.classList.add('editing');
                    } else {
                        // Lógica para guardar cambios (opcionalmente se puede usar AJAX aquí)
                        fila.querySelectorAll('input').forEach(function(input) {
                            const parent = input.parentElement;
                            if (input.type !== 'file') {
                                parent.textContent = input.value; // Actualizar texto
                            }
                        });

                        // Cambiar botón Guardar a Editar
                        this.textContent = 'Editar';
                        fila.classList.remove('editing');
                    }
                });
            });
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
        if (isset($_POST['borrarBus'])) {
            if (isset($eliminacionExisto)) {
                // Eliminacion correcta
                echo '<div class="alert alert-success" role="alert">';
                echo 'El bus ha sido eliminado correctamente';
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
                                <img src="<?= $rutaImg ?>" alt="Bus Image" class="img-fluid" style="width: 100px; height: auto;">
                            </td>
                            <?= form_open(current_url(), ['method' => 'post']) ?>
                            <td><?= $bus->matricula; ?></td>
                            <td data-field="capacidad"><?= $bus->capacidad; ?></td>
                            <td data-field="modelo"><?= $bus->modelo; ?></td>
                            <td>
                                <?php
                                // echo form_input([
                                //     'name' => 'modificarBus',
                                //     'type' => 'submit',
                                //     'class' => 'btn btn-warning btn-sm btn-editar',
                                //     'value' => 'Editar'
                                // ]);
                                ?>
                                <?= form_close(); ?>
                                <button type="submit" class="btn btn-warning btn-sm btn-editar">Editar</button>
                            </td>
                            <td>
                                <!-- Borrar -->
                                <!-- Formulario para que pase la matricula y borra -->
                                <?= form_open(current_url(), ['method' => 'post']) ?>
                                <?php
                                echo form_hidden('matricula', $bus->matricula);  // paso la matricula
                                echo form_input([
                                    'name' => 'borrarBus',
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'value' => 'Borrar'
                                ]);
                                ?>
                                <?= form_close(); ?>
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