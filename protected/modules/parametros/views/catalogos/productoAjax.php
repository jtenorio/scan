<table width="100%">
	<tr>
		<th>Código</th>
		<th>Marca</th>
		<th>Modelo</th>
	</tr>
	<?php
	/* @var $prod Producto */
	foreach ($lista as $prod):
		$txt = "$prod->codigo|$prod->marca|$prod->modelo";
		$js = "selectProducto($prod->id,'$txt')";
	?>
		<tr>
			<td><?php echo CHtml::link($prod->codigo, 'javascript:' . $js);	?></td>
			<td><?php echo $prod->marca ?></td>
			<td><?php echo $prod->modelo; ?></td>
		</tr>
<?php endforeach; ?>
</table>