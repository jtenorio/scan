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
		<?php echo $form->label($model,'asunto'); ?>
		<?php echo $form->textField($model,'asunto',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_ingreso'); ?>
		<?php echo $form->textField($model,'fecha_ingreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_modificacion'); ?>
		<?php echo $form->textField($model,'fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_incio'); ?>
		<?php echo $form->textField($model,'fecha_incio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_fin'); ?>
		<?php echo $form->textField($model,'fecha_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_fin_real'); ?>
		<?php echo $form->textField($model,'fecha_fin_real'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado_llamada'); ?>
		<?php echo $form->textField($model,'estado_llamada',array('size'=>36,'maxlength'=>36)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion_llamada'); ?>
		<?php echo $form->textField($model,'direccion_llamada',array('size'=>36,'maxlength'=>36)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tiempo_recordatorio'); ?>
		<?php echo $form->textField($model,'tiempo_recordatorio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'padre_tipo'); ?>
		<?php echo $form->textField($model,'padre_tipo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado_sistema'); ?>
		<?php echo $form->checkBox($model,'estado_sistema'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'padre_id'); ?>
		<?php echo $form->textField($model,'padre_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->