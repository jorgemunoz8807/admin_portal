<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php $this->load->view('includes/header'); ?>


<body style="max-width: 1440px; margin: auto; padding-top: 5px; ">


<div class="pc-header" style="height: 106px;">

    <a href="http://cuba2008.cuba.cu/"><img src="<?php echo base_url() ?>./css/images/logo.png"></a>

</div>


<div>
    <?php $this->load->view('includes/menu_view'); ?>

</div>


<div class="container pc-session-info">
    <!--    <p class="title">Bienvenido a la Administración del Portal Cuba</p>-->

    <div class="pc-panel-main">
        <!--        Content-->
        <div class="pc-panel">
            <p><a class="pc-panel-title" href="<?php echo base_url() ?>home">Contenidos</a></p>

            <div class="pc-body-panel">
                <div class="pc-panel-description">

                    <p class="subtitle">Descripción breve de lo que indica la sección.</p>
                </div>
            </div>
        </div>
        <!--        News-->
        <div class="pc-panel">
            <p><a href="<?php echo base_url() ?>news" class="pc-panel-title">Noticias</a></p>

            <div class="pc-body-panel">
                <div class="pc-panel-description">

                    <p class="subtitle"> Descripción breve de lo que indica la sección.</p>
                </div>
            </div>
        </div>
        <!--        Sites-->
        <div class="pc-panel">
            <p><a href="<?php echo base_url() ?>sites" class="pc-panel-title">Sitios</a></p>

            <div class="pc-body-panel">
                <div class="pc-panel-description">

                    <p class="subtitle">Descripción breve de lo que indica la sección.</p>
                </div>
            </div>
        </div>
        <!--        Banner-->
        <div class="pc-panel">
            <p><a href="<?php echo base_url() ?>banner" class="pc-panel-title">Banner</a></p>

            <div class="pc-body-panel">
                <div class="pc-panel-description">

                    <p class="subtitle">Descripción breve de lo que indica la sección.</p>
                </div>
            </div>
        </div>
        <!--        Services-->
        <div class="pc-panel">
            <p><a href="<?php echo base_url() ?>home" class="pc-panel-title">Servicios</a></p>

            <div class="pc-body-panel">
                <div class="pc-panel-description">

                    <p class="subtitle">Descripción breve de lo que indica la sección.</p>
                </div>
            </div>
        </div>
        <!--        Gestion-->
        <div class="pc-panel">
            <p><a href="<?php echo base_url() ?>home" class="pc-panel-title">Gestión</a></p>

            <div class="pc-body-panel">
                <div class="pc-panel-description">

                    <p class="subtitle">Descripción breve de lo que indica la sección.</p>
                </div>
            </div>
        </div>


    </div>
</div>
</body>
<?php $this->load->view('includes/footer'); ?>


</html>