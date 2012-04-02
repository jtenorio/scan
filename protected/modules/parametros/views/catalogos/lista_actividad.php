
<table width="100%">
	<tr>
		<th>Código</th>
		<th>Nombre</th>
	</tr>
	<?php
	/* @var $prod Catalogo */
	foreach ($provider->getData() as $prod):
		$js = "selectActividad('$prod->codigo','$prod->valor')";
	?>
		<tr>
			<td><?php echo CHtml::link($prod->codigo, 'javascript:' . $js);	?></td>
			<td><?php echo $prod->valor ?></td>
		</tr>
<?php endforeach; ?>
</table>

