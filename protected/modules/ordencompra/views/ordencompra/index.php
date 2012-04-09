<?php
$this->breadcrumbs=array(
	'Ordencompras',
);

$this->menu=array(
	array('label'=>'Create Ordencompra', 'url'=>array('create')),
	array('label'=>'Manage Ordencompra', 'url'=>array('admin')),
);
?>

<h1>Órden de Compra</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
