<?php
$this->breadcrumbs=array(
	'Maestrocheques'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listado de Anticipos', 'url'=>array('index')),
	array('label'=>'Crear Anticipo', 'url'=>array('create')),
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

<h1>Anticipos a proveedor sin factura</h1>

<p>
Opcionalmente puede buscar con los signos (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) la inicio de cada criterio.
</p>



<?php 
//$model->referenciaadicional='4';

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'maestroasiento-grid',
	'dataProvider'=>$model->getAnticiposList(1),
	'filter'=>$model,
	'columns'=>array(
        'razonsocial',    
        'cedularuc',    
        'fecha',
        'numeroegreso',
        'valoranticipo',
        'pagadoanticipo',
        'saldoanticipo',
		array(
                'class'=>'CButtonColumn',
                'template' => '{update}',                         
                'updateButtonUrl'=>'Yii::app()->createUrl("/contabilidad/maestroanticipoproveedor/update",  array("id" =>  $data["idasiento"]))',
		),
       
	),
)); 





?>
