<?php
$this->breadcrumbs=array(
	'Contactos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Contacto', 'url'=>array('admin')),

);
?>

<h1>Crear Nuevo Contacto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
        'documentos'=>$documentos,
        'clientes'=>$clientes,
    )); ?>