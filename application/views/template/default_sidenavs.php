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
        <h2>John Doe</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <br>
    <!-- Sidebar Menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a ><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('productos') ?>">Catálogo Productos</a></li>
              <li><a href="<?php echo base_url('sucursales') ?>">Sucursales</a></li>
              <li><a href="<?php echo base_url('Lineas') ?>">Líneas</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> Gestión de Ventas <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('movimientos/ventas') ?>">Ventas</a></li>
              <li><a href="<?php echo base_url('example/table_ex') ?>">Table</a></li>
              <li><a href="<?php echo base_url('example/table_dyn_ex') ?>">Table Dynamics</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> Gestión de Pedidos <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('example/form_ex') ?>">General Form</a></li>
              <li><a href="<?php echo base_url('example/table_ex') ?>">Table</a></li>
              <li><a href="<?php echo base_url('example/table_dyn_ex') ?>">Table Dynamics</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> Gestión de Sucursales <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('example/form_ex') ?>">General Form</a></li>
              <li><a href="<?php echo base_url('example/table_ex') ?>">Table</a></li>
              <li><a href="<?php echo base_url('example/table_dyn_ex') ?>">Table Dynamics</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> Gestión de Empleados <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('empleados') ?>">Empleados</a></li>
              <li><a href="<?php echo base_url('example/table_ex') ?>">Table</a></li>
              <li><a href="<?php echo base_url('example/table_dyn_ex') ?>">Table Dynamics</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> Informes <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('example/form_ex') ?>">General Form</a></li>
              <li><a href="<?php echo base_url('example/table_ex') ?>">Table</a></li>
              <li><a href="<?php echo base_url('example/table_dyn_ex') ?>">Table Dynamics</a></li>
            </ul>
          </li>


        </ul>
      </div>
    </div>
    <!-- /Sidebar Menu -->

    <!-- menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>