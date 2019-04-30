<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

      <div class="x_content">
        <?php if ($this->session->flashdata("error")): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&time</button>

            <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
          </div>
        <?php endif;?>
        <br />
        <form action="<?php echo base_url(); ?>movimientos/ventas/store" method="POST" class="form-horizontal">
          <div class="form-group">
            <div class="col-md-3">
              <label for="numero">Numero:</label>
              <input type="text" class="form-control" value="<?php echo $ultimaVenta + 1; ?>" id="numero" name="numero" readonly>

            </div>
            <div class="col-md-3">

            </div>
            <div class="col-md-3">

            </div>

          </div>
          <div class="form-group">
            <div class="col-md-6">
              <label for="">Empleado:</label>
              <div class="input-group">
                <input type="hidden" class="form-control" name="id_empleado" id="id_empleado">

                <input type="text" class="form-control" name="empleado" id="empleado">

                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                </span>
              </div><!-- /input-group -->
            </div>
            <div class="col-md-3">
              <label for="fecha">Fecha:</label>
              <input type="date" class="form-control" name="fecha_venta" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
              <label for="producto">Producto:</label>
              <input type="text" class="form-control" id="producto" name="producto" value="">
            </div>
            <div class="col-md-2">
              <label for="btn-agregar">&nbsp;</label>
              <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
            </div>
          </div>
          <table id="tbventas" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Cantidad</th>
                <th>subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <div class="form-group">
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon">Subtotal:</span>
                <input type="text" class="form-control" placeholder="Username" name="subtotalFactura" readonly="readonly">
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon">IVA:</span>
                <input type="text" class="form-control" placeholder="Username" name="iva" readonly="readonly">
              </div>
            </div>

            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-addon">Total:</span>
                <input type="text" class="form-control" placeholder="Username" name="total" readonly="readonly">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <button type="submit" class="btn btn-success btn-flat">Guardar</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->


<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Lita de Empleados</h4>
      </div>
      <div class="modal-body">
        <table id="datatable-responsive" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>cedula</th>
              <th>Nombre</th>
              <th>opcion</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($empleados)): ?>
              <?php foreach ($empleados as $empleado): ?>
                <tr>
                  <?php $dataempleado = $empleado->id_empleado . "*" . $empleado->cedula . "*" . $empleado->nombre . "*" . $empleado->apellido . "*" . $empleado->telefono . "*" . $empleado->correo . "*" . $empleado->rol_id . "*" . $empleado->sucursal_id?>
                  <td><?php echo $empleado->id_empleado ?></td>
                  <td><?php echo $empleado->cedula ?></td>
                  <td><?php echo $empleado->nombre . " " . $empleado->apellido ?></td>
                  <td><button type="button" class="btn btn-success btn-check" value="<?php echo $dataempleado ?>"><span class="fa fa-check"></span></button></td>
                </tr>
              <?php endforeach?>
            <?php endif?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  //agregado personal
  var base_url = "<?php echo base_url(); ?>"

</script>