<?php
$this->breadcrumbs=array(
	'Reunions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reunion', 'url'=>array('index')),
	array('label'=>'Create Reunion', 'url'=>array('create')),
	array('label'=>'Update Reunion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reunion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reunion', 'url'=>array('admin')),
);
?>

<h1>View Reunion #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_view',array(
            'data'=>$model,
        )); 
?>
<script type="text/javascript">
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/calendario', 'agenda');
</script>