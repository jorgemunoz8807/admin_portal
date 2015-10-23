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


<!--<div class="panel-info" style="height: 80px; background-color: white">

</div>-->

<div class="content">

    <?php if (isset($output)) : ?>
        <?php echo $output; ?>
    <?php endif; ?>

    <?php if (isset($records)) {
        echo '</br>';
        echo '</br>';
        echo '</br>';
        /*  echo $this->pagination->create_links();
          echo $this->table->generate($records);
          echo $this->pagination->create_links();*/

        echo '<div>' . $this->pagination->create_links();
        echo '<a href="#" class="btn btn-default btn-primary " role="button">Crear Noticias</a></div>';
        echo '</br>';

        foreach ($records as $rss) {
            echo '<div>
                      <div class=" ">
                      <input type="">
                      <h4><b>' . $rss['title'] . '</b></h4>
                      </div>' .
                '<p> ' . $rss['pubDate'] . '</p>' .
                '<p>' . $rss['description'] . '</p>' .
                '<a>' . $rss['link'] . '</a>' .
                '</div>';
            echo ' </br > ';
        }

        echo $this->pagination->create_links();
    } ?>

</div>


</body>


<?php $this->load->view('includes/footer'); ?>

</html>