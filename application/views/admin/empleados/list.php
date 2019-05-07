<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <a href="<?php echo base_url() ?>empleados/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span>Agregar empleados</a>
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
            <th class="column-title">Cédula</th>
            <th class="column-title">Nombre</th>
            <th class="column-title">Apellido</th>
            <th class="column-title">Teléfono</th>
            <th class="column-title">Correo</th>
            <th class="column-title">Rol</th>
            <th class="column-title">Sucursal</th>
            <th class="column-title "><span class="nobr">Opciones</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($empleados)): ?>
        <?php foreach ($empleados as $empleado): ?>
        <td class=" "><?php echo $empleado->id_empleado; ?></td>
        <td class=" "><?php echo $empleado->cedula; ?></td>
        <td class=" "><?php echo $empleado->nombre; ?></td>
        <td class=" "><?php echo $empleado->apellido; ?></td>
        <td class=" "><?php echo $empleado->telefono; ?></td>
        <td class=" "><?php echo $empleado->correo; ?></td>
         <td class=" "><?php echo $empleado->rol; ?></td>
          <td class=" "><?php echo $empleado->sucursal; ?></td>
        <td class=" last">
          <div class="btn-group">
            <button type="button" class="btn btn-info btn-view-emple" data-toggle="modal" data-target=".bs-example-modal-lg" value="<?php echo $empleado->id_empleado ?>"><span class="fa fa-search"></span></button>
            <a href="<?php echo base_url() ?>empleados/edit/<?php echo $empleado->id_empleado; ?>" title="" class="btn btn-warning "><span class="fa fa-pencil"></span></a>
            <a href="<?php echo base_url() ?>empleados/delete/<?php echo $empleado->id_empleado; ?>" title="" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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
var base_url= "<?php echo base_url(); ?>"
</script>