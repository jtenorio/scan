<?php
$this->breadcrumbs=array(
	'Documentos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Documento', 'url'=>array('index')),
	array('label'=>'Manage Documento', 'url'=>array('admin')),
);
?>

<h1>Create Documento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>