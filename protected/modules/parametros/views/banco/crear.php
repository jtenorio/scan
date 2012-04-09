<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','Banco'); ?></h1>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'banco-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
    'focus'=>array($model,'firstName'),
)); ?>
<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
<br>
<?php echo $form->errorSummary($model); ?>
<br>
    <?php echo CHtml::hiddenField('scenario', 'insert')?>
    <?php echo $form->labelEx($model,'codigobanco'); ?>
    <?php echo $form->textField($model,'codigobanco',array('size'=>2)); ?>
    <?php echo $form->error($model,'codigobanco'); ?>
    <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('CodigoBanco_tooltip','Parametros','Banco'),
			'effect' => 'normal'
	));
	?>
<br>
    <?php echo $form->labelEx($model,'nombre'); ?>
    <?php echo $form->textField($model,'nombre',array('size'=>30)); ?>
    <?php echo $form->error($model,'nombre'); ?>
    <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Nombre_tooltip','Parametros','Banco'),
			'effect' => 'normal'
	));
     ?>
<br>
    <?php echo $form->labelEx($model,'direccion'); ?>
    <?php echo $form->textField($model,'direccion',array('size'=>60)); ?>
    <?php echo $form->error($model,'direccion'); ?>
    <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Direccion_tooltip','Parametros','Banco'),
			'effect' => 'normal'
	));
	?>
<br>
    <?php echo $form->labelEx($model,'telefono'); ?>
    <?php echo $form->textField($model,'telefono',array('size'=>30)); ?>
    <?php echo $form->error($model,'telefono'); ?>
    <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Telefono_tooltip','Parametros','Banco'),
			'effect' => 'normal'
	));
	?>
<br>
    <?php echo $form->labelEx($model,'paginaweb'); ?>
    <?php echo $form->textField($model,'paginaweb',array('size'=>50)); ?>
    <?php echo $form->error($model,'paginaweb'); ?>
    <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Paginaweb_tooltip','Parametros','Banco'),
			'effect' => 'normal'
	));
     ?>
<br>
    <?php
$this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
?>

<?php $this->endWidget(); ?>
