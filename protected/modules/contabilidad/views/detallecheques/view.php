<?php
$this->breadcrumbs=array(
	'Detalleasientoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detalleasientos', 'url'=>array('index')),
	array('label'=>'Create Detalleasientos', 'url'=>array('create')),
	array('label'=>'Update Detalleasientos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detalleasientos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detalleasientos', 'url'=>array('admin')),
);
?>

<h1>View Detalleasientos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idasiento',
		'cuentacontable',
		'valordebe',
		'valorhaber',
		'subdetalle',
		'idempresa',
	),
)); ?>
