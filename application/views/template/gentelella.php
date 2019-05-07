<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <!-- Import CSS -->
    <link href="<?php echo base_url('assets/template/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/jquery-ui/jquery-ui.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url('assets/template/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/template/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') ?>" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/css/custom.min.css') ?>" rel="stylesheet">
    <!-- /Import CSS -->
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php echo $sidenavs ?>
        <?php echo $navs ?>
        <!-- Page Content -->
        <div class="right_col" role="main">
          <div>
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $header ?></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <?php echo $content ?>
          </div>
        </div>
        <!-- /Page Content -->
        <!-- Footer Content -->
        <footer>
          <div class="pull-right">
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /Footer Content -->
      </div>
    </div>
    <!-- Import Javascript -->
    <script src="<?php echo base_url('assets/template/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/jquery-ui/jquery-ui.js') ?>"></script>
    <!-- highcharts -->
    <script src="<?php echo base_url('assets/template/highcharts/highcharts.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/highcharts/exporting.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/highcharts/export-data.js') ?>"></script>

    <!-- Bootstrap Date Range Picker -->
    <script src="<?php echo base_url('assets/template/moment/min/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/autosize/dist/autosize.min.js') ?>"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url('assets/template/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/datatables.net-responsive-bs/js/responsive.bootstrap.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/pdfmake/build/pdfmake.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/template/pdfmake/build/vfs_fonts.js') ?>"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
    <!-- /Import Javascript -->
  </body>
</html>