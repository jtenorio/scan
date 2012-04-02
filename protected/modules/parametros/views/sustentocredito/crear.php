<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','SustentoCredito'); ?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sustento-credito-form',
	'enableAjaxValidation'=>false,
     'enableClientValidation'=>false,
    'focus'=>array($model,'codigo'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
<?php echo CHtml::hiddenField('scenario', 'insert')?>
	<?php echo $form->errorSummary($model); ?>

        <br>
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'codigo'); ?>
                <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('codigo_tooltip','Parametros','SustentoCredito'),
			'effect' => 'normal'
        	));
            ?>

        <br>

	
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>120));
                
                
                        
                ?>
		<?php echo $form->error($model,'nombre'); ?>
        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombre_tooltip','Parametros','SustentoCredito'),
			'effect' => 'normal'
        	));
            ?>
	<br>

	<br>
    <?php
$this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
?>

<?php $this->endWidget(); ?>