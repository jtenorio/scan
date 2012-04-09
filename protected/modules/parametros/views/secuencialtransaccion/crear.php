<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','SecuencialTransaccion'); ?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'secuencial-transaccion-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'codigo'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
        <?php echo CHtml::hiddenField('scenario', 'insert')?>
	<?php echo $form->errorSummary($model); ?>
        <br>
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'codigo'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('codigo_tooltip','Parametros','SecuencialTransaccion'),
			'effect' => 'normal'
	));
     ?>
            <br>
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'nombre'); ?>
            <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombre_tooltip','Parametros','SecuencialTransaccion'),
			'effect' => 'normal'
	));
     ?>
            <br>
		<?php echo $form->labelEx($model,'modulousarse'); ?>
		<?php echo $form->textField($model,'modulousarse'); ?>
		<?php echo $form->error($model,'modulousarse'); ?>
            <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('modulousarse_tooltip','Parametros','SecuencialTransaccion'),
			'effect' => 'normal'
            	));
            ?>
            <br>
		<?php echo $form->labelEx($model,'ididentificacion'); ?>
		<?php echo $form->dropDownList($model,'ididentificacion',  CHtml::listData(Tipoidentificacion::model()->findAll(),'id','nombre')); ?>
		<?php echo $form->error($model,'ididentificacion'); ?>
<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('ididentificacion_tooltip','Parametros','SecuencialTransaccion'),
			'effect' => 'normal'
	));
     ?>
            <br>

		<?php echo $form->labelEx($model,'tipocomprobanterelacionado'); ?>
		<?php echo $form->textField($model,'tipocomprobanterelacionado'); ?>
		<?php echo $form->error($model,'tipocomprobanterelacionado'); ?>
<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('tipocomprobanterelacionado_tooltip','Parametros','SecuencialTransaccion'),
			'effect' => 'normal'
	));
     ?>
            <br>

	<br>
    <?php
$this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
?>

<?php $this->endWidget(); ?>
