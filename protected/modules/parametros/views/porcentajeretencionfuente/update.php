<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>



<h1><?php echo MessageHandler::transformar('UpdateTitle','Parametros','PorcentajeRetencionFuente',array('{nombre}'=>$model->porcentaje)) ?></h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'porcentaje-retencion-fuente-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'porcentaje'),
));  ?>

	<p class="note">Campos con  <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>


		<?php echo $form->labelEx($model,'porcentaje'); ?>
		<?php echo $form->textField($model,'porcentaje',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'porcentaje'); ?>
                <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('porcentaje_tooltip','Parametros','PorcentajeRetencionFuente'),
			'effect' => 'normal'
        	));
            ?>

        <br>
    <?php
        $this->widget('BotonesWidget',array('permitidos'=>array('save','delete','exit')));
    ?>

    <?php $this->endWidget(); ?>
