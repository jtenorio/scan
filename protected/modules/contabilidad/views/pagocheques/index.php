<?php
$this->breadcrumbs=array(
	'Maestroasientos',
);

$this->menu=array(
	array('label'=>'Create Maestroasiento', 'url'=>array('create')),
	array('label'=>'Manage Maestroasiento', 'url'=>array('admin')),
);
?>

<h1>Pagos Realizados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
