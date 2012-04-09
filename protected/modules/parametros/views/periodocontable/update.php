<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('UpdateTitle','Parametros','PeriodoContable',array('{nombre}'=>$model->nombre)) ?></h1>

 <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'periodo-contrable-form',
	'enableAjaxValidation'=>false,
         'enableClientValidation'=>false,
        'focus'=>array($model,'nombre'),
)); ?>

	<p class="note">Campos <span class="required">*</span> son requeridos.</p>

        	<?php echo $form->errorSummary($model); ?>


		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'nombre'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombre_tooltip','Parametros','PeriodoContable'),
			'effect' => 'normal'
	));
     ?>
        <br>


		<?php echo $form->labelEx($model,'mesnumero'); ?>
		<?php echo $form->dropDownList($model,'mesnumero',$meses); ?>
		<?php echo $form->error($model,'mesnumero'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('mesnumero_tooltip','Parametros','PeriodoContable'),
			'effect' => 'normal'
	));
     ?>
        <br>


		<?php echo $form->labelEx($model,'idejercicio'); ?>
		<?php echo $form->dropDownList($model, 'idejercicio',CHtml::listData(
             EjercicioContable::model()->findAll(), 'id', 'ubicacion'),array('prompt'=>'Seleccione el ejercicio')); ?>
		<?php echo $form->error($model,'idejercicio'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idejercicio_tooltip','Parametros','PeriodoContable'),
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
                                'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','PeriodoContable'),
                                'effect' => 'normal'
                ));
         ?>
    <br>

	<?php
            $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
        ?>

<?php $this->endWidget(); ?>
