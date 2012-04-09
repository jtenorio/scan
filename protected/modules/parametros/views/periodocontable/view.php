<?php
$this->breadcrumbs=array(
	'Periodo Contrables'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PeriodoContrable', 'url'=>array('index')),
	array('label'=>'Create PeriodoContrable', 'url'=>array('create')),
	array('label'=>'Update PeriodoContrable', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PeriodoContrable', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PeriodoContrable', 'url'=>array('admin')),
);
?>

<h1>View PeriodoContrable #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'mesnumero',
		'idejercicio',
		'idempresa',
	),
)); ?>
