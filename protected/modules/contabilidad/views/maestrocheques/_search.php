<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idasiento'); ?>
		<?php echo $form->textField($model,'idasiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numeroasiento'); ?>
		<?php echo $form->textField($model,'numeroasiento',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'periodocontable'); ?>
		<?php echo $form->textField($model,'periodocontable',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cedularuc'); ?>
		<?php echo $form->textField($model,'cedularuc',array('size'=>13,'maxlength'=>13)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'beneficiario'); ?>
		<?php echo $form->textField($model,'beneficiario',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechacreacion'); ?>
		<?php echo $form->textField($model,'fechacreacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechamodificacion'); ?>
		<?php echo $form->textField($model,'fechamodificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'detalle'); ?>
		<?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>254)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iddocumento'); ?>
		<?php echo $form->textField($model,'iddocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numerodocumento'); ?>
		<?php echo $form->textField($model,'numerodocumento',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idcuentabancaria'); ?>
		<?php echo $form->textField($model,'idcuentabancaria'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idcomprobantecontable'); ?>
		<?php echo $form->textField($model,'idcomprobantecontable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numerocomprobante'); ?>
		<?php echo $form->textField($model,'numerocomprobante',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->checkBox($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mayorizado'); ?>
		<?php echo $form->checkBox($model,'mayorizado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'impreso'); ?>
		<?php echo $form->checkBox($model,'impreso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valormovimiento'); ?>
		<?php echo $form->textField($model,'valormovimiento',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'referenciaadicional'); ?>
		<?php echo $form->textField($model,'referenciaadicional',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asientocuadrado'); ?>
		<?php echo $form->checkBox($model,'asientocuadrado'); ?>
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