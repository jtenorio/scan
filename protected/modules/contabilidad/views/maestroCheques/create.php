<?php
$this->breadcrumbs=array(
	'Maestrocheques'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Ver Egresos', 'url'=>array('admin')),
	//array('label'=>'Manage Maestroasiento', 'url'=>array('admin')),
);


?>

<h1>Crear Egreso - Emisi&oacute;n de cheques</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'comprobanteData'=>$comprobanteData,
    'documentoData'=>$documentoData,
    'cuentasData'=>$cuentasData,
    'numeroComp'=>$numeroComp,
    'numeroDoc'=>$numeroDoc,
    'mensaje'=>$mensaje)); ?>