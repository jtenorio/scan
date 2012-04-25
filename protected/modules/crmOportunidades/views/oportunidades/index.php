<?php
$this->breadcrumbs=array(
	'Oportunidads',
);

$this->menu=array(
	array('label'=>'Create Oportunidad', 'url'=>array('create')),
	array('label'=>'Manage Oportunidad', 'url'=>array('admin')),
);
?>

<h1>Oportunidads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
