<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contacto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	

	<div class="row">
		<?php echo $form->labelEx($model,'nombres'); ?>
		<?php echo $form->textField($model,'nombres',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'nombres'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'apellidos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_oficina'); ?>
		<?php echo $form->textField($model,'telefono_oficina',array('size'=>36,'maxlength'=>36)); ?>
		<?php echo $form->error($model,'telefono_oficina'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_celular'); ?>
		<?php echo $form->textField($model,'telefono_celular',array('size'=>36,'maxlength'=>36)); ?>
		<?php echo $form->error($model,'telefono_celular'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_alternativo'); ?>
		<?php echo $form->textField($model,'telefono_alternativo',array('size'=>36,'maxlength'=>36)); ?>
		<?php echo $form->error($model,'telefono_alternativo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_cumpleanos'); ?>
		<?php 
                $valorFacha = strlen($model->fecha_cumpleanos)>1?$model->fecha_cumpleanos:date('Y-m-d');
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name'=>'Contacto[fecha_cumpleanos]',
                                    'value'=>$valorFacha,
                                    
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                        'showAnim'=>'fold',
                                        'dateFormat'=> 'yy-mm-dd',
                                        'changeMonth'=> true,
                                        'changeYear'=> true,            
                                        'showButtonPanel'=> true,
                                    ),
                                    'htmlOptions'=>array(
                                        'style'=>'height:20px;',
                                        'readonly'=>'readonly',
                                    ),
                                ));  ?>
		<?php echo $form->error($model,'fecha_cumpleanos'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'tipodocumento'); ?>
		<?php //echo $form->textField($model,'tipodocumento',array('size'=>20,'maxlength'=>20)); ?>
                <?php echo $form->dropDownList($model,'tipodocumento',$documentos)?>
		<?php echo $form->error($model,'tipodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numerodocumento'); ?>
		<?php echo $form->textField($model,'numerodocumento',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'numerodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idcliente'); ?>
		<?php echo $form->textField($model,'idcliente'); ?>
		<?php echo $form->error($model,'idcliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idequipo'); ?>
		<?php echo $form->textField($model,'idequipo'); ?>
		<?php echo $form->error($model,'idequipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idusuario'); ?>
		<?php echo $form->textField($model,'idusuario'); ?>
		<?php echo $form->error($model,'idusuario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->