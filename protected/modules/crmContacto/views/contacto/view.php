<?php
$this->breadcrumbs=array(
	'Contactos'=>array('index'),
	$model->id,
);

$this->menu=array(

	array('label'=>'Crear', 'url'=>array('create')),
	array('label'=>'Modificar', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),

);
?>

<h1>Contacto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombres',
		'apellidos',
		'fecha_ingreso',
		'fecha_modificacion',
		'telefono_oficina',
		'telefono_celular',
		'telefono_alternativo',
		'fecha_cumpleanos',
		'estado_sistema',
		'tipodocumento',
		'numerodocumento',
		'idcliente',
		'idequipo',
		'idusuario',
	),
)); ?>
