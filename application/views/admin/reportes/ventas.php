<div class="box box-solid">
  <div class="box-body">
    <div class="row">
      <form action="<?php echo current_url(); ?>" method="post" accept-charset="utf-8" class="form-horizontal">
        <div class="form-group">
          <label for="" class="col-md-1 control-label">Desde</label>
          <div class="col-md-3">
            <input type="date" class="form-control" name="fechainicio" value="<?php echo !empty($fechainicio) ? $fechainicio : ''; ?>" >

          </div>
          <label for="" class="col-md-1 control-label">Hasta</label>
          <div class="col-md-3">
            <input type="date" class="form-control" name="fechafin" value="<?php echo !empty($fechafin) ? $fechafin : ''; ?>" >


          </div>
<div class="col-md-4">


          <div class="btn-group ">
            <input type="submit" class="btn btn-primary" value="Buscar" name="buscar" >
  <a href="<?php echo base_url(); ?>reportes/ventas" class="btn btn-danger" title="">Restablecer</a>
          </div>
</div>
</div>
      </form>
    </div>

  </div>

</div>




<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_content">

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="headings">

                <th class="column-title"># </th>
                <th class="column-title">fecha</th>
               <th class="column-title">total</th>
               <th class="column-title">vendedor</th>


                <th class="column-title "><span class="nobr">Opciones</span>
                </th>

              </tr>
            </thead>

            <tbody>


              <?php if (!empty($ventas)): ?>
                <?php foreach ($ventas as $venta): ?>

                <td class=" "><?php echo $venta->id_venta; ?></td>
                <td class=" "><?php echo $venta->fecha_venta; ?></td>
               <td class=" "><?php echo $venta->total; ?></td>
               <td class=" "><?php echo $venta->vendedor; ?></td>

                <td class=" last">
                 <div class="btn-group">
                  <button type="button" class="btn btn-info btn-view-venta" data-toggle="modal" data-target=".modal-default" value="<?php echo $venta->id_venta ?>"><span class="fa fa-search"></span></button>

                 </div>
                </td>
              </tr>

                <?php endforeach?>
              <?php endif?>

            </tbody>
          </table>
        </div>
        </div>
      </div>

 <!-- Large modal -->



                  <div class="modal fade modal-default" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-default">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Información de la venta</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
<!-- <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print">Imprimir</span></button> ojo se puede utilizar jquery print plugin-->
                        </div>

                      </div>
                    </div>
                  </div>

    <!-- //Large modal -->
<script>


  //agregado personal
    var base_url= "<?php echo base_url(); ?>"





</script>