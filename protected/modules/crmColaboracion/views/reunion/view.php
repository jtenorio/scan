<?php
$this->breadcrumbs=array(
	'Reunions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reunion', 'url'=>array('index')),
	array('label'=>'Create Reunion', 'url'=>array('create')),
	array('label'=>'Update Reunion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reunion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reunion', 'url'=>array('admin')),
);
?>

<h1>View Reunion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'asunto',
		'fecha_ingreso',
		'fecha_modificacion',
		'descripcion',
		'lugar',
		'fecha_inicio',
		'fecha_fin',
		'fecha_fin_real',
		'estado_reunion',
		'tiempo_recordatorio',
		'padre_tipo',
		'estado_sistema',
		'padre_id',
		'idusuario',
		'idequipo',
	),
)); ?>
