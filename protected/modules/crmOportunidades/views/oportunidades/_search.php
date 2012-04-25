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
		<?php echo $form->label($model,'nombre_oportunidad'); ?>
		<?php echo $form->textField($model,'nombre_oportunidad',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_modificacion'); ?>
		<?php echo $form->textField($model,'fecha_modificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tomacontacto'); ?>
		<?php echo $form->textField($model,'tomacontacto',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad_oportunidad'); ?>
		<?php echo $form->textField($model,'cantidad_oportunidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipo_oportunidad'); ?>
		<?php echo $form->textField($model,'tipo_oportunidad',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_posiblecierre'); ?>
		<?php echo $form->textField($model,'fecha_posiblecierre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_realcierre'); ?>
		<?php echo $form->textField($model,'fecha_realcierre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'etapa_venta'); ?>
		<?php echo $form->textField($model,'etapa_venta',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probabilidad'); ?>
		<?php echo $form->textField($model,'probabilidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cliente_id'); ?>
		<?php echo $form->textField($model,'cliente_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado_sistema'); ?>
		<?php echo $form->checkBox($model,'estado_sistema'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mediocontacto'); ?>
		<?php echo $form->textField($model,'mediocontacto',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'detallecontacto'); ?>
		<?php echo $form->textField($model,'detallecontacto',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->