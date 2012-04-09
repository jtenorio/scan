<?php
$this->breadcrumbs=array(
	'Ordencompras'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'List Ordencompra', 'url'=>array('index')),
//	array('label'=>'Create Ordencompra', 'url'=>array('create')),
//	array('label'=>'View Ordencompra', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Ordencompra', 'url'=>array('admin')),
//);
?>

<h1>Aprobar Órden de Compra</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'aprobar'=>true,'estado'=>$estado)); ?>