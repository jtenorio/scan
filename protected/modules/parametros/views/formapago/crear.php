<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','FormaPago'); ?></h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forma-pago-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'nombre'),
)); ?>

	<p class="note">Campos con  <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>


		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'nombre'); ?>
            <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('CodigoBanco_tooltip','Parametros','Banco'),
			'effect' => 'normal'
	));
	?>


	<br>


    <?php
        $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
    ?>

        <br>

<?php $this->endWidget(); ?>