<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'oportunidad-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_oportunidad'); ?>
		<?php echo $form->textField($model,'nombre_oportunidad',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombre_oportunidad'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'tomacontacto'); ?>
		<?php echo $form->textField($model,'tomacontacto',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tomacontacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cantidad_oportunidad'); ?>
		<?php echo $form->textField($model,'cantidad_oportunidad'); ?>
		<?php echo $form->error($model,'cantidad_oportunidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_oportunidad'); ?>
		<?php echo $form->textField($model,'tipo_oportunidad',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tipo_oportunidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_posiblecierre'); ?>
		<?php
        $valorFacha = strlen($model->fecha_posiblecierre)>1?$model->fecha_posiblecierre:date('Y-m-d');
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name'=>'Oportunidad[fecha_posiblecierre]',
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
                                ));?>
		<?php echo $form->error($model,'fecha_posiblecierre'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'etapa_venta'); ?>
		<?php echo $form->textField($model,'etapa_venta',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'etapa_venta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'probabilidad'); ?>
		<?php echo $form->textField($model,'probabilidad'); ?>
		<?php echo $form->error($model,'probabilidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cliente_id'); ?>
		<?php $this->widget('AutocompleterAjaxWidget', array(
                            'fieldId'=>'cliente_id',
                            'fieldName'=>'Oportunidad[cliente_id]',
                            'data'=>$clientes,
                            'idColumn'=>'id',
                            'nameColumn'=>'nombrecompleto',

                    )
                 );?>
		<?php echo $form->error($model,'cliente_id'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'mediocontacto'); ?>
		<?php echo $form->textField($model,'mediocontacto',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'mediocontacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detallecontacto'); ?>
		<?php echo $form->textField($model,'detallecontacto',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'detallecontacto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->