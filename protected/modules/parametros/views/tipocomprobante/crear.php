<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','Banco'); ?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tipo-comprobante-form',
	'enableAjaxValidation'=>false,
     'enableClientValidation'=>false,
    'focus'=>array($model,'codigo'),
)); ?>

	<p class="note">Campos con  <span class="required">*</span> son requeridos.</p>
<?php echo CHtml::hiddenField('scenario', 'insert')?>
	<?php echo $form->errorSummary($model); ?>

        <br>
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'codigo'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('codigo_tooltip','Parametros','TipoComprobante'),
			'effect' => 'normal'
	));
     ?>
	<br>

	
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('descripcion_tooltip','Parametros','TipoComprobante'),
			'effect' => 'normal'
	));
     ?>
	<br>

<?php echo $form->labelEx($model,'sustentotributariorelacionado'); ?>
		<?php echo $form->textField($model,'sustentotributariorelacionado',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'sustentotributariorelacionado'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('sustentotributariorelacionado_tooltip','Parametros','TipoComprobante'),
			'effect' => 'normal'
	));
     ?>
	<br>
	 <?php
$this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
?>
<?php $this->endWidget(); ?>

