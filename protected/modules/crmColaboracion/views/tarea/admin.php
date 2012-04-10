<?php
$this->breadcrumbs=array(
	'Tareas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Tarea', 'url'=>array('index')),
	array('label'=>'Create Tarea', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tarea-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tareas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tarea-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre_tarea',
		'fecha_ingreso',
		'fecha_modificacion',
		'descripcion',
		'bandera_fecha_fin',
		/*
		'fecha_fin',
		'fecha_inicio',
		'padre_tipo',
		'estado_sistema',
		'fecha_real_fin',
		'padre_id',
		'idusuario',
		'idequipo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
