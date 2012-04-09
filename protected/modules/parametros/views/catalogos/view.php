<?php $this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Regresar', array('index')),
	),
));
?>

<?php $cols=array('clase','codigo','valor','descripcion','secuencia');?>

<h1>Item del catálogo</h1>

<table class="tabla_vertical">
	<?php foreach($cols as $col):?>
	<tr>
	<th>
	<?php echo ucwords($col)?>
	</th>
	<td>
	<?php echo $model->$col;?>
	</td>
	</tr>
	<?php endforeach;?>
</table>

<?php if ($model->padre){
	echo "PADRE: ";
	$padre = $model->padre;
	$text = $padre->codigo .' '. FormatUtil::truncate($padre->valor, 50);
	echo CHtml::link($text, array('view', 'id'=>$padre->id));	
}

?>
