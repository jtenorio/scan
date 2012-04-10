<?php
$this->breadcrumbs=array(
	'Tareas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tarea', 'url'=>array('index')),
	array('label'=>'Manage Tarea', 'url'=>array('admin')),
);
?>

<h1>Create Tarea</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>