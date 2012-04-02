<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('UpdateTitle','Parametros','Marca',array('{nombre}'=>$model->nombre)) ?></h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'marca-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'nombre'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

        <br>
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombre_tooltip','Parametros','Marca'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'idempresa'); ?>
		<?php  echo $form->dropDownList($model, 'idempresa',CHtml::listData(
                    Empresa::model()->findAll(), 'idempresa', 'razonsocial')); ?>
		<?php echo $form->error($model,'idempresa'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','Marca'),
			'effect' => 'normal'
	));
	?>
	<br>

    <?php
            $this->widget('BotonesWidget',array('permitidos'=>array('save','delete','exit')));
    ?>

<?php $this->endWidget(); ?>
