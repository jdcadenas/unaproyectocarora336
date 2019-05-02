
<div class="row">
	<div class="col-xs-12 text-center">
		<b>Carora Color VenezuelaC.A.</b><br>
		UNA 336 <br>
		José Cadenas <br>
		Correo: jdcadenas@gmail.com
	</div>
</div> <br>
<div class="row">
	<div class="col-xs-6">
		<b>VENDEDOR</b><br>
		<b>Nombre:</b>
		 <?php echo $venta->nombrevendedor . " " . $venta->apellidovendedor; ?> <br>
		<b>Cédula:</b> <?php echo $venta->cedula ?><br>
		<b>Teléfono:</b><?php echo $venta->telefono ?> <br>
		<b>Correo</b> <?php echo $venta->correo ?><br>
	</div>
	<div class="col-xs-6">
		<b>SUCURSAL</b> <br>
		<b>Nombre:</b> <?php echo $venta->sucursal ?><br>

		<b>Ubicación:</b> <?php echo $venta->ubicacion ?><br>
		<b>Fecha</b> <?php echo $venta->fecha_venta ?>
	</div>
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($detalles as $detalle): ?>
				<tr>
					<td><?php echo $detalle->Codigo ?></td>
					<td><?php echo $detalle->nombre ?>L</td>
					<td><?php echo $detalle->precio_venta ?></td>
					<td><?php echo $detalle->cantidad ?></td>
					<td><?php echo ($detalle->precio_venta * $detalle->cantidad) ?></td>
				</tr>
<?php endforeach;?>
			</tbody>
			<tfoot>


				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td><?php echo $venta->total ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>