<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.datepicker.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" />

<script>
    $(function(){
          $('#documento-form').ajaxForm(function(result) {
              $('#formulario').html(result);
            });
    });

	$(function() {
		$( "#Documento_fechacaducidad" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#Documento_fechapublicacion" ).datepicker({ dateFormat: 'yy-mm-dd' });

	});
</script>

<div class="form" id="formulario">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documento-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>



    <div class="row">
        <?php echo $form->labelEx($model, 'tipodocumento'); ?>
        <?php //echo $form->textField($model,'tipodocumento',array('size'=>60,'maxlength'=>60)); ?>
        <?php
        $this->widget('ComboFromArrayWidget', array(
            'arrayKey' => 'tipoDocumento',
            'name' => 'Documento[tipodocumento]',
            'id' => 'Documento_tipodocumento',
                )
        );
        ?>
    <?php echo $form->error($model, 'tipodocumento'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'estadodocumento'); ?>
		<?php
            echo $form->dropDownList($model,'estadodocumento',array(
                0=>'Inactivo',
                1=>'Activo'
                ),array());
        ?>
		<?php echo $form->error($model,'estadodocumento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'categoria'); ?>
		<?php //echo $form->textField($model,'categoria',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'categoria'); ?>

        <?php $this->widget('ComboFromArrayWidget', array(
                            'arrayKey'=>'categoria',
                            'name'=>'Documento[categoria]',
                            'id'=>'Documento_categoria',
                    )
                 );?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subcategoria'); ?>
		<?php echo $form->textField($model,'subcategoria',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'subcategoria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechapublicacion'); ?>
		<?php
            $hoy = date("Y-m-d");
            echo $form->textField($model,'fechapublicacion',array('value'=>$hoy,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'fechapublicacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechacaducidad'); ?>
		<?php echo $form->textField($model,'fechacaducidad',array('value'=>$hoy,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'fechacaducidad'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->