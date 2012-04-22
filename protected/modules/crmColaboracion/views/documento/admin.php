<?php
$this->breadcrumbs=array(
	'Documentos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Documento', 'url'=>array('index')),
	array('label'=>'Create Documento', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('documento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Documentos</h1>

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

<?php 
    $route = '/index.php/crmColaboracion/documento/update';
    $params=array();
    $this->widget('AjaxedGridView', array(
	'dataSet'=>$model,
	'columnsToShow'=>array(
		'id',
		'nombre',
		'fechaingreso',		
		'tipodocumento',
		'estadodocumento',
		'categoria',
		'subcategoria',
		'fechapublicacion',
		'fechacaducidad',		
	),
    'divToAjax'=>'agenda',
    'urlToAjax'=>$this->createUrl($route,$params),
    'keyName'=>'id',
)); ?>
