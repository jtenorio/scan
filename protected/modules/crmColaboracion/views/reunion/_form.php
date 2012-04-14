<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.datepicker.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" />

<script>
    $(function(){
          $('#reunion-form').ajaxForm(function(result) {
              $('#formulario').html(result);
            });
    });

	$(function() {
		$( "#Reunion_fecha_inicio" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#Reunion_fecha_fin" ).datepicker({ dateFormat: 'yy-mm-dd' });

	});
	</script>
    
<div class="form" id="formulario">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reunion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'asunto'); ?>
		<?php echo $form->textField($model,'asunto',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'asunto'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'fecha_ingreso'); ?>
		<?php echo $form->textField($model,'fecha_ingreso'); ?>
		<?php echo $form->error($model,'fecha_ingreso'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'fecha_modificacion'); ?>
		<?php echo $form->textField($model,'fecha_modificacion'); ?>
		<?php echo $form->error($model,'fecha_modificacion'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lugar'); ?>
		<?php echo $form->textArea($model,'lugar',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'lugar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_inicio'); ?>
		<?php
            $hoy = date("Y-m-d");
            echo $form->textField($model,'fecha_inicio',array('value'=>$hoy,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_fin'); ?>
		<?php echo $form->textField($model,'fecha_fin',array('value'=>$hoy,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'fecha_fin'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'fecha_fin_real'); ?>
		<?php echo $form->textField($model,'fecha_fin_real'); ?>
		<?php echo $form->error($model,'fecha_fin_real'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'estado_reunion'); ?>
		<?php 
            echo $form->dropDownList($model,'estado_reunion',array(
                0=>'Pendiente',
                1=>'En ejecucion',
                2=>'Finalizada',
                3=>'Cancelada'
                ),array()); 
            ?>
		<?php echo $form->error($model,'estado_reunion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tiempo_recordatorio'); ?>
		<?php echo $form->dropDownList($model,'tiempo_recordatorio',array(
                0=>'No alertar',
                1=>'1 Dia',
                2=>'2 Dias',
                3=>'3 Dias'
                ),array()); 
        ?>
		<?php echo $form->error($model,'tiempo_recordatorio'); ?>
	</div>


<!--	<div class="row">
		<?php echo $form->labelEx($model,'estado_sistema'); ?>
		<?php echo $form->checkBox($model,'estado_sistema'); ?>
		<?php echo $form->error($model,'estado_sistema'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'padre_id'); ?>
		<?php echo $form->textField($model,'padre_id'); ?>
		<?php echo $form->error($model,'padre_id'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'idusuario'); ?>
		<?php echo $form->textField($model,'idusuario'); ?>
		<?php echo $form->error($model,'idusuario'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'idequipo'); ?>
		<?php echo $form->textField($model,'idequipo'); ?>
		<?php echo $form->error($model,'idequipo'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->