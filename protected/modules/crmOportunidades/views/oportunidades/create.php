<?php
$this->breadcrumbs=array(
	'Oportunidads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Oportunidad', 'url'=>array('index')),
	array('label'=>'Manage Oportunidad', 'url'=>array('admin')),
);
?>

<h1>Create Oportunidad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
        'clientes'=>$clientes)); ?>