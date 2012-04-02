<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('UpdateTitle','Parametros','TipoProveedor',array('{nombre}'=>$model->nombre)) ?></h1>

<?php $form = $this->beginWidget('CActiveForm', array(
    	'id'=>'tipo-proveedor-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
    'focus'=>array($model,'nombre'),
)); ?>
<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
<br>
<?php echo $form->errorSummary($model); ?>
<br>
<?php echo CHtml::hiddenField('scenario', 'insert')?>
    <?php echo $form->labelEx($model,'nombre'); ?>
    <?php echo $form->textField($model,'nombre',array('size'=>30)); ?>
    <?php echo $form->error($model,'nombre'); ?>
    <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Nombre_tooltip','Parametros','TipoProveedor'),
			'effect' => 'normal'
	));
     ?>
<br>
    <?php
$this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
?>

<?php $this->endWidget(); ?>
