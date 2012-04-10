<?php
$this->breadcrumbs=array(
	'Documentos',
);

$this->menu=array(
	array('label'=>'Create Documento', 'url'=>array('create')),
	array('label'=>'Manage Documento', 'url'=>array('admin')),
);
?>

<h1>Documentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
