<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idcuentabancaria'); ?>
		<?php echo $form->textField($model,'idcuentabancaria'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idbanco'); ?>
		<?php echo $form->textField($model,'idbanco'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numerocuenta'); ?>
		<?php echo $form->textField($model,'numerocuenta',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idcuentanec'); ?>
		<?php echo $form->textField($model,'idcuentanec'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asistentecuenta'); ?>
		<?php echo $form->textField($model,'asistentecuenta',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefonoasistente'); ?>
		<?php echo $form->textField($model,'telefonoasistente',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ayudanteasistente'); ?>
		<?php echo $form->textField($model,'ayudanteasistente',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chequeautomatico'); ?>
		<?php echo $form->checkBox($model,'chequeautomatico'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numerocheque'); ?>
		<?php echo $form->textField($model,'numerocheque',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ubicacionimpresion'); ?>
		<?php echo $form->textField($model,'ubicacionimpresion',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idempresa'); ?>
		<?php echo $form->textField($model,'idempresa'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->