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
		<?php echo $form->label($model,'idempresa'); ?>
		<?php echo $form->textField($model,'idempresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaingreso'); ?>
		<?php echo $form->textField($model,'fechaingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'detalle'); ?>
		<?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numeroorden'); ?>
		<?php echo $form->textField($model,'numeroorden',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'anulado'); ?>
		<?php echo $form->checkBox($model,'anulado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idusuario'); ?>
		<?php echo $form->textField($model,'idusuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idusuarioaprueba'); ?>
		<?php echo $form->textField($model,'idusuarioaprueba'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaaprueba'); ?>
		<?php echo $form->textField($model,'fechaaprueba'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idproveedor'); ?>
		<?php echo $form->textField($model,'idproveedor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->