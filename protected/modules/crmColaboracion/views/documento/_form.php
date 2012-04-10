<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documento-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaingreso'); ?>
		<?php echo $form->textField($model,'fechaingreso'); ?>
		<?php echo $form->error($model,'fechaingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechamodificacion'); ?>
		<?php echo $form->textField($model,'fechamodificacion'); ?>
		<?php echo $form->error($model,'fechamodificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipodocumento'); ?>
		<?php echo $form->textField($model,'tipodocumento',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'tipodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estadodocumento'); ?>
		<?php echo $form->textField($model,'estadodocumento',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'estadodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'categoria'); ?>
		<?php echo $form->textField($model,'categoria',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'categoria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subcategoria'); ?>
		<?php echo $form->textField($model,'subcategoria',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'subcategoria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechapublicacion'); ?>
		<?php echo $form->textField($model,'fechapublicacion'); ?>
		<?php echo $form->error($model,'fechapublicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechacaducidad'); ?>
		<?php echo $form->textField($model,'fechacaducidad'); ?>
		<?php echo $form->error($model,'fechacaducidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idusuario'); ?>
		<?php echo $form->textField($model,'idusuario'); ?>
		<?php echo $form->error($model,'idusuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idequipo'); ?>
		<?php echo $form->textField($model,'idequipo'); ?>
		<?php echo $form->error($model,'idequipo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->