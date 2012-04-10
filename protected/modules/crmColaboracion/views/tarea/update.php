<?php
$this->breadcrumbs=array(
	'Tareas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tarea', 'url'=>array('index')),
	array('label'=>'Create Tarea', 'url'=>array('create')),
	array('label'=>'View Tarea', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tarea', 'url'=>array('admin')),
);
?>

<h1>Update Tarea <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>