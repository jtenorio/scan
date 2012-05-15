<?php
$this->breadcrumbs=array(
	'Oportunidads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(

	array('label'=>'Crear', 'url'=>array('create')),

	array('label'=>'Listar', 'url'=>array('admin')),
);
?>

<h1>Oportunidad <?php echo $model->nombre_oportunidad; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
        'clientes'=>$clientes,
    )); ?>