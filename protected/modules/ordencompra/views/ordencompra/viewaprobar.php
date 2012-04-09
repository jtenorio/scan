<?php
$this->breadcrumbs=array(
	'Ordencompras'=>array('index'),
	$model->id,
);


    $this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Aprobar', array('updateaprobar', 'id'=>$model->id)),
                array('Buscar', array('ordencompra/adminaprobar')),
	),
));


//$this->menu=array(
//	array('label'=>'List Ordencompra', 'url'=>array('index')),
//	array('label'=>'Create Ordencompra', 'url'=>array('create')),
//	array('label'=>'Update Ordencompra', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Ordencompra', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Ordencompra', 'url'=>array('admin')),
//);
?>

<h1>Ver Órden de Compra Para Aprobar</h1>
<?php echo $this->renderPartial('_view', array('data'=>$model)); ?>

<?php
    $this->widget('GrillaordencompraWidget',array('text'=>$model->id,'tipo'=>'ver'));
?>
