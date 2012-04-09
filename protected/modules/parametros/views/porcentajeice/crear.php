<?php

/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','PorcentajeIce'); ?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'porcentaje-ice-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'codigo'),
));  ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
        <br>
	
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'codigo'); ?>
         <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('codigo_tooltip','Parametros','PorcentajeIce'),
			'effect' => 'normal'
        	));
            ?>
	<br>

	
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
         <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('descripcion_tooltip','Parametros','PorcentajeIce'),
			'effect' => 'normal'
        	));
            ?>
        <br>

	
		<?php echo $form->labelEx($model,'porcentaje'); ?>
		<?php echo $form->textField($model,'porcentaje',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'porcentaje'); ?>
         <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('porcentaje_tooltip','Parametros','PorcentajeIce'),
			'effect' => 'normal'
        	));
            ?>
        <br>


	
		<?php echo $form->labelEx($model,'vigentedesde'); ?>
		<?php echo $form->textField($model,'vigentedesde', array('class'=>'fecha')); ?>
		<?php echo $form->error($model,'vigentedesde'); ?>
            <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('vigentendesde_tooltip','Parametros','PorcentajeIce'),
			'effect' => 'normal'
        	));
            ?>
        <br>

	
		<?php echo $form->labelEx($model,'vigentehasta'); ?>
		<?php echo $form->textField($model,'vigentehasta',array('class'=>'fecha')); ?>
		<?php echo $form->error($model,'vigentehasta'); ?>
        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('vigentenhasta_tooltip','Parametros','PorcentajeIce'),
			'effect' => 'normal'
        	));
            ?>
	<br>

	
		<?php echo $form->labelEx($model,'cuentacontable'); ?>
		<?php //echo $form->textField($model,'cuentacontable'); ?>
                        <?php
                        echo CHtml::textField('nombrecuenta', Plancuentasnec::model()->buscaNombre($model->cuentacontable), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la Cuenta','javascript:escogeCuenta();');

                echo $form->hiddenField($model,'cuentacontable',array('size'=>30,'readonly'=>true));


                        ////echo $form->dropDownList($model, 'cuentacontable', CHtml::listData(
                    /*PlanCuentasNec::model()->findAll(
                            array(
                                'order'=>' "cuentacontable" ',
                                'condition'=>' "tipocuenta" =:x',
                                'params'=>array(':x'=>false)
                                )
                            ), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta'));*/
                ?>

		<?php echo $form->error($model,'cuentacontable'); ?>
        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontable_tooltip','Parametros','PorcentajeIce'),
			'effect' => 'normal'
        	));
            ?>
	<br>


		<?php echo $form->labelEx($model,'idempresa'); ?>
		<?php //echo $form->textField($model,'idempresa'); ?>
		<?php echo $form->dropDownList($model, 'idempresa',CHtml::listData(
                    Empresa::model()->findAll(), 'idempresa', 'razonsocial'));?>
                <?php echo $form->error($model,'idempresa'); ?>
	<?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','PorcentajeIce'),
			'effect' => 'normal'
        	));
            ?>

	<br>
    <?php
$this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
?>

<?php $this->endWidget(); ?>
<?php $this->widget('SelectorDatepickerWidget', FormatUtil::defaultDateOptions('fecha'));?>

<?php $this->widget('ModelosWidget', array(
	'id' => 'cuentacontable_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCuentaContable',
        'title'=>'Seleccione Cuenta Contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Porcentajeice',
        'obj_name'=>'nombrecuenta',
        'obj_fk'=>'cuentacontable',
        'busqueda'=>'busquedaCuenta',
));?>
<script type="text/javascript">
    function escogeCuenta() {

            $("#cuentacontable_dlg").dialog("open");
    }

  
    onSelectCuentaContable = function(fk,nombre,objfk,name){
            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#cuentacontable_dlg").dialog("close");
    }

</script>