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
		<?php echo $form->label($model,'cedularuc'); ?>
		<?php echo $form->textField($model,'cedularuc',array('size'=>13,'maxlength'=>13)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'razonsocial'); ?>
		<?php echo $form->textField($model,'razonsocial',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ciudad'); ?>
		<?php echo $form->textField($model,'ciudad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipodocumento'); ?>
		<?php echo $form->textField($model,'tipodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contacto'); ?>
		<?php echo $form->textField($model,'contacto',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nota1'); ?>
		<?php echo $form->textField($model,'nota1',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nota2'); ?>
		<?php echo $form->textField($model,'nota2',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'saldo'); ?>
		<?php echo $form->textField($model,'saldo',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentacontableporpagar'); ?>
		<?php echo $form->textField($model,'cuentacontableporpagar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuentacontableanticipo'); ?>
		<?php echo $form->textField($model,'cuentacontableanticipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'autorizacionfactura'); ?>
		<?php echo $form->textField($model,'autorizacionfactura',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechacaducidad'); ?>
		<?php echo $form->textField($model,'fechacaducidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtipoproveedor'); ?>
		<?php echo $form->textField($model,'idtipoproveedor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->