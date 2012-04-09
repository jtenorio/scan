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
		<?php echo $form->label($model,'porcentaje'); ?>
		<?php echo $form->textField($model,'porcentaje',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vigentedesde'); ?>
		<?php echo $form->textField($model,'vigentedesde'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vigentehasta'); ?>
		<?php echo $form->textField($model,'vigentehasta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentacontablecredito'); ?>
		<?php echo $form->textField($model,'cuentacontablecredito'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentacontablegasto'); ?>
		<?php echo $form->textField($model,'cuentacontablegasto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentacontableventa'); ?>
		<?php echo $form->textField($model,'cuentacontableventa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->