<h1 class="text-center">ULTIMAS RESERVAS COMPLETADAS</h1>

<?php 
    if (isset($_POST['msg'])) {
        var_dump($msg);
    }

?>

<?= form_open(site_url('/opinion/add'), ['method' => 'post']); ?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>Nº ruta</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Hora llegada</th>
            <th>Bus</th>
        </tr>

        <tbody>
            <?php foreach($opin as $o): ?>
            <tr>
                <td><input type="checkbox" name="selected_tickets[]" value="<?= $o['id_ticket']; ?>"></td>

                <td><?= $o['id_ruta']; ?></td>
                <td><?= $o['origen']; ?></td>
                <td><?= $o['destino']; ?></td>
                <td><?= $o['hLlegada']; ?></td>
                <td><img src="<?= base_url('/images/buses/'.$o['img']); ?>" height="100px" width="100%" /></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </thead>

</table>

    <div class="form-group">
        <label for="comentario">Opinion:</label>
        <?= form_input(['name' => 'comentario', 'id' => 'comentario', 'class' => 'form-control']); ?>
    </div>
    <?= form_submit('btnOpinar', 'Enviar', ['class' => 'btn btn-primary']); ?>

<?= form_close(); ?>
                

<?php 
    // var_dump($msg);

  
    // foreach ($opin as $p) {
    //     echo $p['id_ticket'];
    //     echo $p['id_ruta'];
    //     echo $p['origen'];
    //     echo $p['destino'];
    //     echo $p['hLlegada'];
    // }



?>