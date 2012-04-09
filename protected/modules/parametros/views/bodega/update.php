<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','Bodega'); ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bodega-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'nombre'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

        <br>
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'nombre'); ?>
            <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombre_tooltip','Parametros','Bodega'),
			'effect' => 'normal'
	));
	?>

	<br>
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('direccion_tooltip','Parametros','Bodega'),
			'effect' => 'normal'
	));
	?>
	<br>
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('telefono_tooltip','Parametros','Bodega'),
			'effect' => 'normal'
	));
	?>
        <br>
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fax'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('fax_tooltip','Parametros','Bodega'),
			'effect' => 'normal'
	));
	?>
        <br>
		<?php echo $form->labelEx($model,'responsable'); ?>
		<?php echo $form->textField($model,'responsable',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'responsable'); ?>
                <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('responsable_tooltip','Parametros','Bodega'),
			'effect' => 'normal'
	));
	?>
        <br>
		<?php echo $form->labelEx($model,'nota'); ?>
		<?php echo $form->textField($model,'nota',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'nota'); ?>
          <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nota_tooltip','Parametros','Bodega'),
			'effect' => 'normal'
	));
	?>
        <br>
		<?php echo $form->labelEx($model,'idempresa'); ?>
	<?php echo $form->dropDownList($model, 'idempresa',CHtml::listData(
                    Empresa::model()->findAll(), 'idempresa', 'razonsocial'));?>
		<?php echo $form->error($model,'idempresa'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','Bodega'),
			'effect' => 'normal'
	));
	?>
        <br>
	<?php
            $this->widget('BotonesWidget',array('permitidos'=>array('save','delete','exit')));
        ?>


<?php $this->endWidget(); ?>

