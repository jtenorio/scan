<?php
$this->breadcrumbs=array(
	'Maestroasientos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Ver Asientos', 'url'=>array('index')),
//	array('label'=>'Manage Maestroasiento', 'url'=>array('admin')),
);
?>

<h1>Pago Cheques</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'comprobanteData'=>$comprobanteData,
        'documentoData'=>$documentoData,
        'cuentasData'=>$cuentasData)); ?>