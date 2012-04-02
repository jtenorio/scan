<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','PlanCentroCosto'); ?></h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plan-centro-costo-form',
	'enableAjaxValidation'=>false,
            'enableClientValidation'=>false,
        'focus'=>array($model,'cuentagasto'),

)); ?>

	<p class="note">Campos con  <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>


		<?php echo $form->labelEx($model,'cuentagasto'); ?>
		<?php echo $form->textField($model,'cuentagasto',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'cuentagasto'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentagasto_tooltip','Parametros','PlanCentroCosto'),
			'effect' => 'normal'
	));
	?>
        <br>


		<?php echo $form->labelEx($model,'nombrecuenta'); ?>
		<?php echo $form->textField($model,'nombrecuenta',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'nombrecuenta'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombrecuenta_tooltip','Parametros','PlanCentroCosto'),
			'effect' => 'normal'
	));
	?>
        <br>


		<?php echo $form->labelEx($model,'tipocuenta'); ?>
		<?php echo $form->checkBox($model,'tipocuenta',array('disabled'=>true)); ?>
		<?php echo $form->error($model,'tipocuenta'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('tipocuenta_tooltip','Parametros','PlanCentroCosto'),
			'effect' => 'normal'
	));
	?>
        <br>
		<?php echo $form->labelEx($model,'nivelcuenta'); ?>
		<?php echo $form->textField($model,'nivelcuenta',array('size'=>2,'maxlength'=>2,'readonly'=>true)); ?>
		<?php echo $form->error($model,'nivelcuenta'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nivelcuenta_tooltip','Parametros','PlanCentroCosto'),
			'effect' => 'normal'
	));
	?>
        <br>
		<?php echo $form->labelEx($model,'idempresa'); ?>
		<?php echo $form->dropDownList($model, 'idempresa',CHtml::listData(
                    Empresa::model()->findAll(), 'idempresa', 'razonsocial'));?>
		<?php echo $form->error($model,'idempresa'); ?>
                <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','PlanCentroCosto'),
			'effect' => 'normal'
                ));
                ?>
        <br>
        <?php
        $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
        ?>


<?php $this->endWidget(); ?>

