<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idcodretfuente'); ?>
		<?php echo $form->textField($model,'idcodretfuente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'porcentaje'); ?>
		<?php echo $form->textField($model,'porcentaje',array('size'=>8,'maxlength'=>8)); ?>
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
		<?php echo $form->label($model,'pormil'); ?>
		<?php echo $form->checkBox($model,'pormil'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentacontablecompras'); ?>
		<?php echo $form->textField($model,'cuentacontablecompras'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentacontableventas'); ?>
		<?php echo $form->textField($model,'cuentacontableventas'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idcodigoporcentaje'); ?>
		<?php echo $form->textField($model,'idcodigoporcentaje'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->