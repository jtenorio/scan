<?php
$this->breadcrumbs=array(
	'Maestroasientos'=>array('index'),
	$model->idasiento,
);

$this->menu=array(
	array('label'=>'List Maestroasiento', 'url'=>array('index')),
	array('label'=>'Create Maestroasiento', 'url'=>array('create')),
	array('label'=>'Update Maestroasiento', 'url'=>array('update', 'id'=>$model->idasiento)),
	array('label'=>'Delete Maestroasiento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idasiento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Maestroasiento', 'url'=>array('admin')),
);
?>

<h1>View Maestroasiento #<?php echo $model->idasiento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idasiento',
		'numeroasiento',
		'periodocontable',
		'cedularuc',
		'beneficiario',
		'fechacreacion',
		'fechamodificacion',
		'detalle',
		'iddocumento',
		'numerodocumento',
		'idcuentabancaria',
		'idcomprobantecontable',
		'numerocomprobante',
		'estado',
		'mayorizado',
		'impreso',
		'valormovimiento',
		'referenciaadicional',
		'asientocuadrado',
		'idempresa',
	),
)); ?>
