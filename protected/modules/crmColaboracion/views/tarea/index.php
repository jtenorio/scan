<?php
$this->breadcrumbs=array(
	'Tareas',
);

$this->menu=array(
	array('label'=>'Create Tarea', 'url'=>array('create')),
	array('label'=>'Manage Tarea', 'url'=>array('admin')),
);
?>

<h1>Tareas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
