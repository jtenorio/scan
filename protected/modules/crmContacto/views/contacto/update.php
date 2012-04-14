<?php
$this->breadcrumbs=array(
	'Contactos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contacto', 'url'=>array('index')),
	array('label'=>'Create Contacto', 'url'=>array('create')),
	array('label'=>'View Contacto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Contacto', 'url'=>array('admin')),
);
?>

<h1>Update Contacto <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>