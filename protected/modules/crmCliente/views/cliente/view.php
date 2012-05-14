<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id,
);

$this->menu=array(

	array('label'=>'Crear', 'url'=>array('create')),

	array('label'=>'Listar', 'url'=>array('admin')),
);
?>

<h1>Cliente <?php echo $model->nombrecompleto; ?></h1>

<div id="crmInfoCliente">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tipodocumento',
		'numerodocumento',
		'nombrecompleto',
		'fecha_ingreso',
		'fecha_modificacion',
		'tipocuenta',
		'industria',
		'telefono_oficina',
		'fax',
		'telefono_alternativo',
		'direccion_facturacion',
	),
)); ?>
</div>

<div id="crmClienteContactos"></div>

<div id="crmClienteCalendario"></div>

<div id="crmClienteOprtunidades"></div>

<script type="text/javascript">
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmCliente/calendario', 'crmClienteCalendario');
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmCliente/contactos/index/id/<?php echo $model->id?>', 'crmClienteContactos');
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmCliente/oportunidades/index/idCliente/<?php echo $model->id?>', 'crmClienteOprtunidades');
</script>
