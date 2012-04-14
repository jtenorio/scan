<?php
$this->breadcrumbs=array(
	'Llamadas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Llamada', 'url'=>array('index')),
	array('label'=>'Create Llamada', 'url'=>array('create')),
	array('label'=>'Update Llamada', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Llamada', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Llamada', 'url'=>array('admin')),
);
?>

<h1>View Llamada #<?php echo $model->id; ?></h1>

<?php
    $this->renderPartial('_view',array(
			'data'=>$model,
		));
 ?>
<script type="text/javascript">
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/calendario', 'agenda');
</script>