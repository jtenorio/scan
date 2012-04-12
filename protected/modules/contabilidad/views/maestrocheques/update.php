<?php
$this->breadcrumbs=array(
	'Maestroasientos'=>array('index'),
	$model->idasiento=>array('view','id'=>$model->idasiento),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar egresos', 'url'=>array('index')),
	array('label'=>'Crear egreso', 'url'=>array('create')),

);
?>

<h1>Editar Egreso - Emisi&oacute;n de cheques # <?php echo $model->numeroasiento; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'comprobanteData'=>$comprobanteData,
    'documentoData'=>$documentoData,
    'cuentasData'=>$cuentasData,
    'numeroComp'=>$numeroComp,
    'numeroDoc'=>$numeroDoc)); ?>