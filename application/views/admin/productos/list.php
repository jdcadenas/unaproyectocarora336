<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-6">
    <a href="<?php echo base_url() ?>productos/add/<?php echo $ids ?>" class="btn btn-primary btn-flat">
      <span class="fa fa-plus"></span>Agregar Productos</a>
  </div>
   <label class="control-label col-md-6 col-sm-6 col-xs-2 alert-info align-content-md-betweens">Sucursal</label>
   <div class="col-md-6 col-sm-6 col-xs-4">


 <select class="form-control"name="sucursalselect" id="sucursalselect">
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
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_content">
      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr class="headings">
            <th class="column-title"># </th>
            <th class="column-title">codigo</th>
            <th class="column-title">nombre</th>
            <th class="column-title">precio</th>
            <th class="column-title">cantidad</th>
            <th class="column-title">linea</th>
            <th class="column-title">Ubicación</th>
            <th class="column-title "><span class="nobr">Opciones</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($productos)): ?>
        <?php foreach ($productos as $producto): ?>
        <td class=" "><?php echo $producto->id_producto; ?></td>
        <td class=" "><?php echo $producto->codigo; ?></td>
        <td class=" "><?php echo $producto->nombre; ?></td>
        <td class=" "><?php echo $producto->precio; ?></td>
        <td class=" "><?php echo $producto->cantidadAlmacen; ?></td>
        <td class=" "><?php echo $producto->lnombre; ?></td>
        <td class=" "><?php echo $producto->id_sucursal . ' >>' . $producto->sucursal . " " . $producto->ubicacion; ?></td>
        <td class=" last">
          <div class="btn-group">
            <button type="button" class="btn btn-info btn-view-emple" data-toggle="modal" data-target=".bs-example-modal-lg" value="<?php echo $producto->id_producto ?>"><span class="fa fa-search"></span></button>
            <a href="<?php echo base_url() ?>productos/edit/<?php echo $producto->id_producto; ?>/<?php echo $producto->id_sucursal; ?>" title="" class="btn btn-warning "><span class="fa fa-pencil"></span></a>
            <a href="<?php echo base_url() ?>productos/delete/<?php echo $producto->id_producto; ?>" title="" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
<h4 class="modal-title" id="myModalLabel">Información de los empleados</h4>
</div>
<div class="modal-body-emple">
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
var base_url= "<?php echo base_url(); ?>";

</script>