<?php
$this->breadcrumbs=array(
	'Parametro Facturacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ParametroFacturacion', 'url'=>array('index')),
	array('label'=>'Create ParametroFacturacion', 'url'=>array('create')),
	array('label'=>'Update ParametroFacturacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ParametroFacturacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ParametroFacturacion', 'url'=>array('admin')),
);
?>

<h1>View ParametroFacturacion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idempresa',
		'cuentacaja',
		'cuentaventasdoce',
		'cuentaventascero',
		'cuentaivaventas',
		'cuentadescuentoventas',
		'cuentaretfuenteventa',
		'cuentaretivaventa',
		'cuentaporcobrarcliente',
		'cuentareembolsocliente',
		'cuentacomprasdoce',
		'cuentacomprascero',
		'cuentadescuentocompra',
		'cuentaivacompras',
		'cuentaporpagarproveedor',
		'cuentaanticipoproveedor',
		'numerocompra',
	),
)); ?>
