<head>

    <meta charset="utf-8" xml:lang="es"/>
<!--    <link type="text/css" rel="stylesheet"-->
    <!--          href="--><?php //echo base_url(); ?><!--assets/bootstrap/css/bootstrap.min.css"/>-->
    <!--    <link type="text/css" rel="stylesheet" href="--><?php //echo base_url(); ?><!--css/login/base.css"/>-->
    <!--    <link type="text/css" rel="stylesheet" href="--><?php //echo base_url(); ?><!--css/login/layout.css"/>-->

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/template/template.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/template/home.css"/>

    <title>Administración - Portal Cuba </title>
    <link rel="icon" type="image/x-icon" href="http://cuba2008.cuba.cu/logo_chico.ico"/>




    <?php if (isset($css_files)) : ?>
        <?php foreach ($css_files as $file) : ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>"/>

    <?php endforeach; ?>

    <?php foreach ($js_files as $file) : ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>

    <?php endif; ?>

</head>