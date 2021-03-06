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
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
          action="<?php echo base_url(); ?>productos/store" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula">Código <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="codigo" name="codigo" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="precio">Precio <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="precio" name="precio" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cantidad">Cantidad <span class=""></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="cantidad" name="cantidad"  class="form-control col-md-7 col-xs-12">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Línea</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <select class="form-control" name="linea">
        <?php foreach ($lineas as $linea): ?>
        <option value="<?php echo $linea->id_linea ?>">
          <?php echo $linea->nombre_linea ?>
        </option>
        <?php endforeach;?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sucursal</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <select class="form-control" readonly   name="sucursal" id="sucursal">
        <?php foreach ($sucursales as $sucursal): ?>
        <?php if ($sucursal->id == $ids): ?>
        <option value="<?php echo $sucursal->id ?>" selected>
          <?php echo $sucursal->id . '' . $sucursal->nombre ?>
        </option>
        <?php else: ?>
        <option value="<?php echo $sucursal->id ?>" >
          <?php echo $sucursal->id . '' . $sucursal->nombre ?>
        </option>
        <?php endif?>
        <?php endforeach;?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Imagen</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <span class="btn btn-info btn-file">
        <input type="file" name="imagen_producto" value="" placeholder="">
      </span>
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button class="btn btn-primary" type="button">Cancelar</button>
      <button class="btn btn-primary" type="reset">Limpiar</button>
      <button type="submit" class="btn btn-success">Guardar</button>
    </div>
  </div>
</form>
</div>
</div>
</div>
</div>
<!-- Large modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
</button>
<h4 class="modal-title" id="myModalLabel">Información de las Lista</h4>
</div>
<div class="modal-body">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div>
<!-- //Large modal -->
<script>
//agregado personal
var base_url = "<?php echo base_url(); ?>"
</script>