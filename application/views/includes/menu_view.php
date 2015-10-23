<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/menu/styles.css"/>

<div id='cssmenu'>

    <ul>
        <li><a href="<?php echo base_url() ?>home"><span><img
                        src="<?php echo base_url() . './css/images/home15.png' ?>"> Inicio</span></a></li>
        <li class='active has-sub'><a href="<?php echo base_url() ?>tags"><span>Contenidos</span></a>
            <ul>
                <li class='last'><a href="<?php echo base_url() ?>tags"><span>Palabras Claves</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>owners"><span>Propietarios</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>categories"><span>Categorías</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>language"><span>Idioma</span></a></li>
            </ul>
        </li>
        <li class="active has-sub"><a href="<?php echo base_url() ?>news"><span>Noticias</span></a>
            <ul>
                <li class='last'><a href="<?php echo base_url() ?>news"><span>Añadir Noticia</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>news_rss"><span>Añadir Noticia de RSS</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>news_source"><span>Añadir Fuentes</span></a></li>
            </ul>
        </li>
        <li class="active has-sub"><a href="<?php echo base_url() ?>sites"><span>Sitios</span></a>
            <ul>
                <li class='last'><a href="<?php echo base_url() ?>sites"><span>Añadir Sitio</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>sites_type"><span>Tipos de Sitio</span></a></li>
            </ul>
        </li>
        <li class="active has-sub"><a href="<?php echo base_url() ?>banner"><span>Banner</span></a>
            <ul>
                <li class='last'><a href="<?php echo base_url() ?>banner"><span>Añadir Banner</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>banner_type"><span>Tipos de Banner</span></a></li>
            </ul>
        </li>

        <li class="active has-sub"><a href="<?php echo base_url() ?>echange_money"><span>Servicios</span></a>
            <ul>
                <li class='last'><a href="<?php echo base_url() ?>echange_money"><span>Cambio de Moneda</span></a></li>
            </ul>
        </li>
        <li class="active has-sub"><a href="<?php echo base_url() ?>user_role"><span>Gestión</span></a>
            <ul>
                <li class='last'><a href="<?php echo base_url() ?>rss_setting"><span>RSS</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>metas"><span>Meta Datos</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>user_role"><span>Usuarios</span></a></li>
                <li class='last'><a href="<?php echo base_url() ?>user_log"><span>Trazas de Usuarios</span></a></li>
            </ul>
        </li>
        <li><a href="<?php echo base_url() ?>useful_info"><span>Informaciones</span></a></li>

        <div class="cssmenu-user">
            <li class="active has-sub "><a href="">

                    <span>
                        <img
                            src="<?php echo base_url() . './css/images/user_icon.png' ?>">
                        <?= $this->session->userdata('username') ?>
                        </span>
                </a>
                <ul style="width: 100%">
                    <li class='last'>
                         
                        <a href="<?php echo base_url() ?>login/logout_ci"><span>
                              Salir</span></a>
                    </li>
                </ul>
            </li>
        </div>

    </ul>


</div>
