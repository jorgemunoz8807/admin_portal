<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/960.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/text.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/reset.css" media="screen"/>
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
</head>
<body>
<div class="container_12">
    <div class="grid_12">
<!--        <h1 style="text-align: center">Bienvenido de nuevo --><?//= $this->session->userdata('perfil') ?><!--</h1>-->

        <?= $this->session->userdata('perfil') ?>
        <?= anchor(base_url() . 'login/logout_ci', 'Cerrar sesión') ?>
    </div>
</div>
</body>
</html>