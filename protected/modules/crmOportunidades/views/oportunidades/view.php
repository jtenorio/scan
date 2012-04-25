<?php
$this->breadcrumbs=array(
	'Oportunidads'=>array('index'),
	$model->id,
);

$this->menu=array(

	array('label'=>'Crear', 'url'=>array('create')),
	array('label'=>'Modificar', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Listar', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->nombre_oportunidad; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre_oportunidad',
		'fecha_creacion',
		'tomacontacto',
		'cantidad_oportunidad',
		'tipo_oportunidad',
		'fecha_posiblecierre',
		'fecha_realcierre',
		'etapa_venta',
		'probabilidad',
		'cliente_id',
		'mediocontacto',
		'detallecontacto',
	),
)); ?>
