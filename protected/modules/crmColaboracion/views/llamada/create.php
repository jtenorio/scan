<?php
$this->breadcrumbs=array(
	'Llamadas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Llamada', 'url'=>array('index')),
	array('label'=>'Manage Llamada', 'url'=>array('admin')),
);
?>

<h1>Create Llamada</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id)); ?>