<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plan-centro-costo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cuentagasto'); ?>
		<?php echo $form->textField($model,'cuentagasto',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'cuentagasto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombrecuenta'); ?>
		<?php echo $form->textField($model,'nombrecuenta',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'nombrecuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipocuenta'); ?>
		<?php echo $form->checkBox($model,'tipocuenta'); ?>
		<?php echo $form->error($model,'tipocuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nivelcuenta'); ?>
		<?php echo $form->textField($model,'nivelcuenta'); ?>
		<?php echo $form->error($model,'nivelcuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idempresa'); ?>
		<?php echo $form->textField($model,'idempresa'); ?>
		<?php echo $form->error($model,'idempresa'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->