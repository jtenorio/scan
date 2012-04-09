<?php
$this->breadcrumbs=array(
	'Plan Centro Costos'=>array('index'),
	$model->idcuentagasto,
);

$this->menu=array(
	array('label'=>'List PlanCentroCosto', 'url'=>array('index')),
	array('label'=>'Create PlanCentroCosto', 'url'=>array('create')),
	array('label'=>'Update PlanCentroCosto', 'url'=>array('update', 'id'=>$model->idcuentagasto)),
	array('label'=>'Delete PlanCentroCosto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idcuentagasto),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PlanCentroCosto', 'url'=>array('admin')),
);
?>

<h1>View PlanCentroCosto #<?php echo $model->idcuentagasto; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idcuentagasto',
		'cuentagasto',
		'nombrecuenta',
		'tipocuenta',
		'nivelcuenta',
		'idempresa',
	),
)); ?>
