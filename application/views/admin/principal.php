 <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Total Ventas</span>
              <div class="count"><?php echo $cantVentas ?></div>
              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-building"></i> Total Sucursales</span>
              <div class="count green"><?php echo $cantSucursales ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-users"></i> Total Empleados</span>
              <div class="count"><?php echo $cantEmpleados ?></div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-truck"></i> Total Productos</span>
              <div class="count"><?php echo $cantProductos ?></div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

            </div>
          </div>
          <!-- /top tiles -->

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Gráfico Estadístico</h3>
              <div class="box-tools pull-right">
                <select name="year" id="year" class="form-control">
                  <?php foreach ($years as $year): ?>

                     <option value="<?php echo $year->year; ?>">
                       <?php echo $year->year; ?>
                     </option>
                  <?php endforeach?>

                </select>
              </div>

            </div>

          </div>

          <div class="box-body">

          <div class="row">
              <div class="col-md-12">
                        <div id="grafico" style="margin: 0 auto"></div>
              </div>
          </div>
        </div>

        <script>
  //agregado personal
    var base_url= "<?php echo base_url(); ?>"
</script>