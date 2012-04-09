<?php
$this->breadcrumbs=array(
	'Maestroasientos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listado de Pagos', 'url'=>array('admin')),
	array('label'=>'Crear Pago', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('maestroasiento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Pagos con cheque a proveedor registrados</h1>

<p>
Opcionalmente puede buscar con los signos (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) la inicio de cada criterio.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'maestroasiento-grid',
	'dataProvider'=>$model->getPagoProveedor(1),
	'filter'=>$model,
	'columns'=>array(		
		'numeroasiento',		
		'fechacreacion',
                'detalle',
		/*
		'fechamodificacion',
		'detalle',
		'iddocumento',
		'numerodocumento',
		'idcuentabancaria',
		'idcomprobantecontable',
		'numerocomprobante',
		'estado',
		'mayorizado',
		'impreso',
		'valormovimiento',
		
		'asientocuadrado',
		'idempresa',
		*/
		array(
                'class'=>'CButtonColumn',
                'template' => '{update}',                         
                'updateButtonUrl'=>'Yii::app()->createUrl("/contabilidad/maestroasiento/update",  array("id" =>  $data["idasiento"]))',
		),
       
	),
)); 





?>
