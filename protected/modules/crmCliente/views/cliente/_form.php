<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cliente-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tipodocumento'); ?>
		<?php //echo $form->textField($model,'tipodocumento'); ?>
        <?php echo $form->dropDownList($model,'tipodocumento',$documentos)?>

		<?php echo $form->error($model,'tipodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numerodocumento'); ?>
		<?php echo $form->textField($model,'numerodocumento',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'numerodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombrecompleto'); ?>
		<?php echo $form->textField($model,'nombrecompleto',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'nombrecompleto'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'tipocuenta'); ?>
		<?php echo $form->textField($model,'tipocuenta',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'tipocuenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'industria'); ?>
		<?php echo $form->textField($model,'industria',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'industria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_oficina'); ?>
		<?php echo $form->textField($model,'telefono_oficina',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'telefono_oficina'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_alternativo'); ?>
		<?php echo $form->textField($model,'telefono_alternativo',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'telefono_alternativo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion_facturacion'); ?>
		<?php echo $form->textArea($model,'direccion_facturacion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'direccion_facturacion'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->