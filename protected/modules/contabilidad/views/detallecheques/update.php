<?php
$this->breadcrumbs=array(
	'Detalleasientoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detalleasientos', 'url'=>array('index')),
	array('label'=>'Create Detalleasientos', 'url'=>array('create')),
	array('label'=>'View Detalleasientos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detalleasientos', 'url'=>array('admin')),
);
?>

<h1>Update Detalleasientos <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>