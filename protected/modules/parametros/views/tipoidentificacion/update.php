<h1><?php echo MessageHandler::transformar('UpdateTitle','Parametros','TipoIdentificacion',array('{nombre}'=>$model->nombre)); ?></h1>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'tipo-identificacion-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
    'focus'=>array($model,'firstName'),
)); ?>
<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
<br>
	<?php echo $form->errorSummary($model); ?>

	<?php echo CHtml::hiddenField('scenario', 'insert')?>
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'codigo'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Codigo_tooltip','Parametros','TipoIdentificacion',array('{valor1}'=>'R','{valor2}'=>'C','{valor3}'=>'P','{valor4}'=>'F')),
			'effect' => 'normal'
	));
     ?>
            <br>
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nombre'); ?>
            <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Nombre_tooltip','Parametros','TipoIdentificacion'),
			'effect' => 'normal'
	));
     ?>
        <br>

<?php
$this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
?>

<?php $this->endWidget(); ?>
