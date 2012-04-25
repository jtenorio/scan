<?php
$this->breadcrumbs=array(
	'Oportunidads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Oportunidad', 'url'=>array('index')),
	array('label'=>'Create Oportunidad', 'url'=>array('create')),
	array('label'=>'View Oportunidad', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Oportunidad', 'url'=>array('admin')),
);
?>

<h1>Update Oportunidad <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>