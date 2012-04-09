<?php
$this->breadcrumbs=array(
	'Bodegas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bodega', 'url'=>array('index')),
	array('label'=>'Create Bodega', 'url'=>array('create')),
	array('label'=>'Update Bodega', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bodega', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bodega', 'url'=>array('admin')),
);
?>

<h1>View Bodega #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'direccion',
		'telefono',
		'fax',
		'responsable',
		'nota',
		'idempresa',
	),
)); ?>
