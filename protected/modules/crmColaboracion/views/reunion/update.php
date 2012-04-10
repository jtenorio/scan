<?php
$this->breadcrumbs=array(
	'Reunions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reunion', 'url'=>array('index')),
	array('label'=>'Create Reunion', 'url'=>array('create')),
	array('label'=>'View Reunion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Reunion', 'url'=>array('admin')),
);
?>

<h1>Update Reunion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>