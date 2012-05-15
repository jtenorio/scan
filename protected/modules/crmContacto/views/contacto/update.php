<?php
$this->breadcrumbs=array(
	'Contactos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Crear', 'url'=>array('create')),
	array('label'=>'listar', 'url'=>array('admin')),
);
?>

<h1>Modificar Contacto <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
         'documentos'=>$documentos,
         'clientes'=>$clientes,
    )); ?>