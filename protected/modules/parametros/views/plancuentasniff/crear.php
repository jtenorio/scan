<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','PlanCuentasNiff'); ?></h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plan-cuentas-niff-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'cuentacontableniff'),
       ));
?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
        <?php echo CHtml::hiddenField('scenario', 'insert'); ?>
        <br>
	
		<?php echo $form->labelEx($model,'cuentacontableniff'); ?>
		<?php echo $form->textField($model,'cuentacontableniff',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'cuentacontableniff'); ?>
	    <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontableniff_tooltip','Parametros','PlanCuentasNiff'),
			'effect' => 'normal'
        	));
            ?>

        <br>

	
		<?php echo $form->labelEx($model,'nombrecuenta'); ?>
		<?php echo $form->textField($model,'nombrecuenta',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'nombrecuenta'); ?>
        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombrecuenta_tooltip','Parametros','PlanCuentasNiff'),
			'effect' => 'normal'
        	));
            ?>
	<br>

	
		<?php echo $form->labelEx($model,'tipocuenta'); ?>
		<?php echo $form->checkBox($model,'tipocuenta',array('disabled'=>true)); ?>
		<?php echo $form->error($model,'tipocuenta'); ?>
        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('tipocuenta_tooltip','Parametros','PlanCuentasNiff'),
			'effect' => 'normal'
        	));
            ?>
	<br>

	
		<?php echo $form->labelEx($model,'nivelcuenta'); ?>
		<?php echo $form->textField($model,'nivelcuenta',array('size'=>2,'maxlength'=>2,'readonly'=>true)); ?>
		<?php echo $form->error($model,'nivelcuenta'); ?>
        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nivelcuenta_tooltip','Parametros','PlanCuentasNiff'),
			'effect' => 'normal'
        	));
            ?>
	<br>

	    <?php
            $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
            ?>

<?php $this->endWidget(); ?>
