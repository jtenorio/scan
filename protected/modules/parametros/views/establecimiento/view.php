<?php
$this->breadcrumbs=array(
	'Establecimientos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Establecimiento', 'url'=>array('index')),
	array('label'=>'Create Establecimiento', 'url'=>array('create')),
	array('label'=>'Update Establecimiento', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Establecimiento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Establecimiento', 'url'=>array('admin')),
);
?>

<h1>View Establecimiento #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'establecimiento',
		'puntoemision',
		'nombre',
		'numeronotadeventa',
		'numerofactura',
		'numeronotacredito',
		'numeronotaentrega',
		'numeroretencion',
		'autorizacionnotaventa',
		'autorizacionfactura',
		'autorizacionnotacredito',
		'autorizacionretencion',
		'impresionnotaventa',
		'impresionfactura',
		'impresionnotacredito',
		'impresionnotaentrega',
		'impresionretencion',
		'retencionautomatica',
		'documentopredeterminado',
		'bodegapredeterminada',
		'usaservicios',
		'cuentacontableservicios',
		'porcentajeservicios',
		'idempresa',
	),
)); ?>
