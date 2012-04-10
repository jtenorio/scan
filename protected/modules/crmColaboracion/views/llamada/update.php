<?php
$this->breadcrumbs=array(
	'Llamadas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Llamada', 'url'=>array('index')),
	array('label'=>'Create Llamada', 'url'=>array('create')),
	array('label'=>'View Llamada', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Llamada', 'url'=>array('admin')),
);
?>

<h1>Update Llamada <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>