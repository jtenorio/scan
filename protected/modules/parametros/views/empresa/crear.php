<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','Empresa'); ?></h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'ruc'),
));  ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
<?php echo CHtml::hiddenField('scenario', 'insert')?>
	<?php echo $form->errorSummary($model); ?>
        <br>
	
		<?php echo $form->labelEx($model,'ruc'); ?>
		<?php echo $form->textField($model,'ruc',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'ruc'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('ruc_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>



		<?php echo $form->labelEx($model,'razonsocial'); ?>
		<?php echo $form->textField($model,'razonsocial',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'razonsocial'); ?>
         <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('razonsocial_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>


	
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('direccion_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>

	
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('telefono_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>


		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'fax'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('fax_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>


		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'email'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('email_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>
            	<?php echo $form->labelEx($model,'cedularepresentante'); ?>
		<?php echo $form->textField($model,'cedularepresentante',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'cedularepresentante'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cedularepresentante_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>
		<?php echo $form->labelEx($model,'ruccontador'); ?>
		<?php echo $form->textField($model,'ruccontador',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'ruccontador'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('ruccontador_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>

	
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->checkBox($model,'estado'); ?>
		<?php echo $form->error($model,'estado'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('estado_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo $form->textField($model,'logo',array('size'=>60,'maxlength'=>254)); ?>
		<?php echo $form->error($model,'logo'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('logo_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
	<br>


	<?php echo $form->labelEx($model,'idtipoagenteretencion'); ?>
		
        <?php echo $form->dropDownList($model,'idtipoagenteretencion',  CHtml::listData(Tipoagenteretencion::model()->findAll(),'id','nombre')); ?>
		<?php echo $form->error($model,'idtipoagenteretencion'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idtipoagenteretencion_tooltip','Parametros','Empresa'),
			'effect' => 'normal'
	));
	?>
        <br>


    <?php
        $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
    ?>

        <br>
<?php $this->endWidget(); ?>

