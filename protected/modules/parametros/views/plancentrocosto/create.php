<?php
$this->breadcrumbs=array(
	'Plan Centro Costos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PlanCentroCosto', 'url'=>array('index')),
	array('label'=>'Manage PlanCentroCosto', 'url'=>array('admin')),
);
?>

<h1>Create PlanCentroCosto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>