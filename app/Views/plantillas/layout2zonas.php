<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>" >
  </head>
  <body>

    <div class="wrapper d-flex align-items-stretch">

        <?= $this->include("plantillas/vSideBar"); ?>
        
        <?= $this->include("plantillas/barraNav"); ?>

        <?= $this->renderSection("principal"); ?>

    </div>

    <script src="<?= base_url('js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('js/popper.js'); ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('js/main.js'); ?>"></script>
    
  </body>
</html>