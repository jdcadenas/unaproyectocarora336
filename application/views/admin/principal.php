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
 <script src="<?php echo base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
        <script>

  //agregado personal
    var base_url= "<?php echo base_url(); ?>";
    var year = (new Date).getFullYear();
    $("#year").on('change', function() {
        yearselect = $(this).val();
    });
    datagrafico(base_url, year);



function datagrafico(base_url, year) {
    mesesMonth = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    $.ajax({
        url: base_url + "principal/getData",
        type: 'POST',
        dataType: 'json',
        data: {
            year: year
        },
    }).done(function(data) {
        console.log("success");
        var meses = new Array();
        var montos = new Array();
        $.each(data, function(index, value) {
            meses.push(mesesMonth[value.mes - 1]);
            valor = Number(value.monto);
            montos.push(valor);
        });
        graficar(meses, montos, year);
    }).fail(function() {
        console.log("error");
    }).always(function() {
        console.log("complete");
    });
}

function graficar(meses, montos, year) {
    Highcharts.chart('grafico', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monto acumulado por las ventas de los meses'
        },
        subtitle: {
            text: 'Año ' + year
        },
        xAxis: {
            categories: meses,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Monto acumulado Bs'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' + '<td style="padding:0"><b>{point.y:.2f} Bolívares Soberanos</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
            series: {
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return Highcharts.numberFormat(this.y, 2)
                    }
                }
            }
        },
        series: [{
            name: 'Meses',
            data: montos
        }]
    });
}
</script>