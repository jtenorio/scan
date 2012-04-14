<?php
$this->breadcrumbs=array(
	'Tareas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tarea', 'url'=>array('index')),
	array('label'=>'Create Tarea', 'url'=>array('create')),
	array('label'=>'Update Tarea', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tarea', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tarea', 'url'=>array('admin')),
);
?>

<h1>View Tarea #<?php echo $model->id; ?></h1>

<?php
    $this->renderPartial('_view',array(
			'data'=>$model,
		));
?>
<script type="text/javascript">
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/calendario', 'agenda');
</script>
