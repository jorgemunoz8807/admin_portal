<?php $this->load->view('includes/header'); ?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/login/base.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/login/layout.css"/>

<body>
<?php
$username = array('name' => 'username', 'placeholder' => 'Usuario');
$password = array('name' => 'password', 'placeholder' => 'Contraseña');
$submit = array('name' => 'submit', 'value' => 'Iniciar', 'title' => 'Iniciar sesión');
?>


<div class="notice">
    <a href="" class="close">close</a>

    <p class="warning">
        <?= form_error('username') ?>
        <?= form_error('password') ?>
    </p>
</div>

<div class="container">
    <!--    <h3>--><? //= $title?><!--</h3>-->
    <div class="form-bg">

        <?= form_open(base_url() . 'login/new_user') ?>
        <h2>Iniciar</h2>
        <?= form_input($username) ?>
        <!--        --><? //= form_error('username') ?>
        <?= form_password($password) ?>
        <!--        --><? //= form_error('password') ?>
        <?= form_hidden('token', $token) ?>
        <?= form_submit($submit) ?>

        <?= form_close() ?>

    </div>

    <!--    <p class="forgot">Forgot your password? <a href="">Click here to reset it.</a></p>-->

</div>

</body>
