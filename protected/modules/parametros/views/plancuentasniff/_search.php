<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idcuentaniff'); ?>
		<?php echo $form->textField($model,'idcuentaniff'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentacontableniff'); ?>
		<?php echo $form->textField($model,'cuentacontableniff',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombrecuenta'); ?>
		<?php echo $form->textField($model,'nombrecuenta',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipocuenta'); ?>
		<?php echo $form->textField($model,'tipocuenta',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nivelcuenta'); ?>
		<?php echo $form->textField($model,'nivelcuenta',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->