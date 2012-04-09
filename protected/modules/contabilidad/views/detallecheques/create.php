<?php
$this->breadcrumbs=array(
	'Detalleasientoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Detalleasientos', 'url'=>array('index')),
	array('label'=>'Manage Detalleasientos', 'url'=>array('admin')),
);
?>

<h1>Create Detalleasientos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>