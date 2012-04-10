<?php
$this->breadcrumbs=array(
	'Reunions',
);

$this->menu=array(
	array('label'=>'Create Reunion', 'url'=>array('create')),
	array('label'=>'Manage Reunion', 'url'=>array('admin')),
);
?>

<h1>Reunions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
