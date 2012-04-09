<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idcuentagasto'); ?>
		<?php echo $form->textField($model,'idcuentagasto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentagasto'); ?>
		<?php echo $form->textField($model,'cuentagasto',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombrecuenta'); ?>
		<?php echo $form->textField($model,'nombrecuenta',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipocuenta'); ?>
		<?php echo $form->checkBox($model,'tipocuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nivelcuenta'); ?>
		<?php echo $form->textField($model,'nivelcuenta'); ?>
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