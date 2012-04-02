<?php
$this->breadcrumbs=array(
	'Maestroasientos'=>array('index'),
	$model->idasiento=>array('view','id'=>$model->idasiento),
	'Update',
);

$this->menu=array(
	array('label'=>'List Maestroasiento', 'url'=>array('index')),
	array('label'=>'Create Maestroasiento', 'url'=>array('create')),
	array('label'=>'View Maestroasiento', 'url'=>array('view', 'id'=>$model->idasiento)),
	array('label'=>'Manage Maestroasiento', 'url'=>array('admin')),
);
?>

<h1>Update Maestroasiento <?php echo $model->idasiento; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>