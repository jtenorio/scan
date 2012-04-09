<?php
$this->breadcrumbs=array(
	'Maestrocheques'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Ver Pagos', 'url'=>array('admin')),
	//array('label'=>'Manage Maestroasiento', 'url'=>array('admin')),
);


?>

<h1>Cancelaci&oacute;n de cheque a proveedor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'comprobanteData'=>$comprobanteData,
    'documentoData'=>$documentoData,
    'cuentasData'=>$cuentasData,
    'numeroComp'=>$numeroComp,
    'numeroDoc'=>$numeroDoc,
    'mensaje'=>$mensaje,
    'proveedorByRuc'=>$proveedorByRuc,
    'proveedorByName'=>$proveedorByName,
    'loadAnticipos'=>$loadAnticipos,
    'idProveedor'=>$idProveedor,
    
    )); ?>