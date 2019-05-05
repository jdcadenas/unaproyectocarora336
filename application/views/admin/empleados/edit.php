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
          action="<?php echo base_url(); ?>empleados/update" method="post">
          <input type="hidden" name="id_empleado" value="<?php echo $empleado->id_empleado ?>">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula">Cédula <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="cedula" name="cedula" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $empleado->cedula ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $empleado->nombre ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido">Apellido <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="apellido" name="apellido" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $empleado->apellido ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Teléfono <span class=""></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="telefono" name="telefono"  class="form-control col-md-7 col-xs-12" value="<?php echo $empleado->telefono ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="correo" class="control-label col-md-3 col-sm-3 col-xs-12" >correo</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="correo" class="form-control col-md-7 col-xs-12" type="text" name="correo" value="<?php echo $empleado->correo ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido">Usuario <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="usuario" name="usuario" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $empleado->usuario ?>">
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clave">Clave <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="clave" name="clave" required="required" class="form-control col-md-7 col-xs-12"
  value="">
</div>
</div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Rol</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <select class="form-control" name="rol">rol
        <?php foreach ($roles as $rol): ?>
        <?php if ($rol->id_rol == $empleado->rol_id): ?>
        <option value="<?php echo $rol->id_rol ?>" selected>
          <?php echo $rol->rol ?>
        </option>
        <?php else: ?>
        <option value="<?php echo $rol->id_rol ?>" >
          <?php echo $rol->rol ?>
        </option>
        <?php endif?>
        <?php endforeach;?>
      </select>
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sucursal</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <select class="form-control" name="sucursal">
        <?php foreach ($sucursales as $sucursal): ?>
        <?php if ($sucursal->id == $empleado->sucursal_id): ?>
        <option value="<?php echo $sucursal->id ?>" selected>
          <?php echo $sucursal->nombre ?>
        </option>
        <?php else: ?>
        <option value="<?php echo $sucursal->id ?>" >
          <?php echo $sucursal->nombre ?>
        </option>
        <?php endif?>
        <?php endforeach;?>
      </select>
    </div>
  </div>

<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12">Estado</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <div id="estado" class="btn-group" data-toggle="buttons">
    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
      <input type="radio" name="estado" value="1"> &nbsp; Activado &nbsp;
    </label>
    <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
      <input type="radio" name="estado" value="1"> Activado
    </label>
  </div>
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