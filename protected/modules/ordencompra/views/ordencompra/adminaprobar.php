<?php
$this->breadcrumbs=array(
	'Ordencompras'=>array('index'),
	'Manage',
);

//$this->widget('ComandosWidget', array(
//	'comandos' => array(
//		array('Crear', array('create')),
//	),
//));

//$this->menu=array(
//	array('label'=>'List Ordencompra', 'url'=>array('index')),
//	array('label'=>'Create Ordencompra', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ordencompra-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administración de Órdenes de Compras</h1>



<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<br>

<?php
$this->widget('ListaModulosWidget',array('model'=>$model,'id'=>'proveedor'));
?>
<?php
//$this->widget('zii.widgets.grid.CGridView', array(
//	'id'=>'ordencompra-grid',
//	'dataProvider'=>$model->search(),
//	'filter'=>$model,
//	'columns'=>array(
//                'detalle',
//		'fechaingreso',
//		'estado',
//		'numeroorden',
//		/*
//		'anulado',
//		'idusuario',
//		'idusuarioaprueba',
//		'fechaaprueba',
//		'idproveedor',
//		*/
//		array(
//			'class'=>'CButtonColumn',
//		),
//	),
//));
?>
