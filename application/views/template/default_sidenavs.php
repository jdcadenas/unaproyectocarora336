<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo base_url(); ?>" class="site_title"><i class="fa fa-cog"></i> <span style="font-size: 12px;"><?php echo 'Depto de Ventas Carora Color Venezuela, C.A.' ?></span></a>
    </div>
    <div class="clearfix"></div>
    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="<?php echo base_url('assets/images/img.jpg') ?>" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Bienvenido,</span>
        <h2><?php echo $this->session->userdata("nombre") ?> <?php echo $this->session->userdata("apellido") ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <br>
    <!-- Sidebar Menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="<?php echo base_url('principal') ?>"><i class="fa fa-home"></i> Inicio</a>
          <li><a href="<?php echo base_url('movimientos/ventas') ?>">Ventas</a></li>
        </li>
        <li><a ><i class="fa fa-edit"></i> Mantenimiento <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo base_url('productos') ?>">Productos (Stock)</a></li>
          <li><a href="<?php echo base_url('sucursales') ?>">Sucursales</a></li>
          <li><a href="<?php echo base_url('Lineas') ?>">Líneas</a></li>
          <li><a href="<?php echo base_url('empleados') ?>">Empleados</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-edit"></i> Reportes <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
        <li><a href="<?php echo base_url('reportes/ventas') ?>">Ventas</a></li>
        <li><a href="<?php echo base_url('example/table_ex') ?>">Table</a></li>
        <li><a href="<?php echo base_url('example/table_dyn_ex') ?>">Table Dynamics</a></li>
      </ul>
    </li>
  </ul>
</div>
</div>
<!-- /Sidebar Menu -->

</div>
</div>