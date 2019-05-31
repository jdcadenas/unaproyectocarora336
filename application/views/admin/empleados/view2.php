   <?php if (!empty($empleados)): ?>

  <table id="datatable-responsive" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Cédula</th>
              <th>Nombre</th>
              <th>Opcion</th>
            </tr>
          </thead>
          <tbody>

              <?php foreach ($empleados as $empleado): ?>
                <tr>
                  <?php $dataempleado = $empleado->id_empleado . "*" . $empleado->cedula . "*" . $empleado->nombre . "*" . $empleado->apellido . "*" . $empleado->telefono . "*" . $empleado->correo . "*" . $empleado->rol_id . "*" . $empleado->sucursal_id?>
                  <td><?php echo $empleado->id_empleado ?></td>
                  <td><?php echo $empleado->cedula ?></td>
                  <td><?php echo $empleado->nombre . " " . $empleado->apellido ?></td>
                  <td><button type="button" class="btn btn-success btn-check" value="<?php echo $dataempleado ?>"><span class="fa fa-check"></span></button></td>
                </tr>
              <?php endforeach?>


          </tbody>
        </table>
          <?php else: ?>
             <table id="datatable-responsive" class="table table-bordered table-striped table-hover">
              <tr>
                <td>No existen empleados en esta sucursal</td>
              </tr>
            </table>

            <?php endif?>
