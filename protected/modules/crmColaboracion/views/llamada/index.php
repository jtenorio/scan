<?php
$this->breadcrumbs=array(
	'Llamadas',
);

$this->menu=array(
	array('label'=>'Create Llamada', 'url'=>array('create')),
	array('label'=>'Manage Llamada', 'url'=>array('admin')),
);
?>

<h1>Llamadas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
