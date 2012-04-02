<?php
$this->breadcrumbs=array(
	'Detalleasientoses'=>array('index'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'List Detalleasientos', 'url'=>array('index')),
//	array('label'=>'Manage Detalleasientos', 'url'=>array('admin')),
//);

$this->menu=array(
	array('label'=>'Ver Asientos', 'url'=>array('maestroasiento/admin')),
        array('label'=>'Crear Asiento', 'url'=>array('maestroasiento/create')),
	//array('label'=>'Manage Maestroasiento', 'url'=>array('admin')),
);
?>

<h1>Asientos Contables</h1>

<div id="cabeceraAsiento">
    <!--ejemplo de URL /index.php/contabilidad/maestroasiento/update/id/4-->
    <script type="text/javascript">
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestroasiento/update/id/<?php echo $id?>', 'cabeceraAsiento');
    </script>
    
</div>


<div id="detalleAsiento">
    <?php echo $this->renderPartial('_form', array('model'=>$model,'idCabecera'=>$id,'detalle'=>$detalle,
        'cuentasnec'=>$cuentasnec)); ?>
</div>


