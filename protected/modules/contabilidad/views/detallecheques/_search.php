<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idasiento'); ?>
		<?php echo $form->textField($model,'idasiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentacontable'); ?>
		<?php echo $form->textField($model,'cuentacontable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valordebe'); ?>
		<?php echo $form->textField($model,'valordebe',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valorhaber'); ?>
		<?php echo $form->textField($model,'valorhaber',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subdetalle'); ?>
		<?php echo $form->textField($model,'subdetalle',array('size'=>60,'maxlength'=>120)); ?>
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