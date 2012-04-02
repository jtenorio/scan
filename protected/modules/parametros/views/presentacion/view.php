<?php
$this->breadcrumbs=array(
	'Presentacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Presentacion', 'url'=>array('index')),
	array('label'=>'Create Presentacion', 'url'=>array('create')),
	array('label'=>'Update Presentacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Presentacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Presentacion', 'url'=>array('admin')),
);
?>

<h1>View Presentacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'cantidadpresentacion',
		'salida',
		'idempresa',
	),
)); ?>
