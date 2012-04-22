<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','PlanCuentasNec'); ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plan-cuentas-nec-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'cuentacontable'),
)); ?>

	<p class="note">Campos con  <span class="required">*</span> son  requeridos.</p>
<?php echo CHtml::hiddenField('scenario', 'insert')?>
	<?php echo $form->errorSummary($model); ?>
        <br>


		<?php echo $form->labelEx($model,'cuentacontable'); ?>
		<?php echo $form->textField($model,'cuentacontable',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'cuentacontable'); ?>
                <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontable_tooltip','Parametros','PlanCuentasNec'),
			'effect' => 'normal'
                	));
                ?>
                <br>


		<?php echo $form->labelEx($model,'nombrecuenta'); ?>
		<?php echo $form->textField($model,'nombrecuenta',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'nombrecuenta'); ?>
                <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombrecuenta_tooltip','Parametros','PlanCuentasNec'),
			'effect' => 'normal'
                	));
                ?>
                <br>
                <?php echo $form->labelEx($model,'tipocuenta'); ?>
		<?php echo $form->checkBox($model,'tipocuenta',array('disabled'=>true)); ?>
		<?php echo $form->error($model,'tipocuenta'); ?>
                <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('tipocuenta_tooltip','Parametros','PlanCuentasNec'),
			'effect' => 'normal'
                	));
                ?>
                <br>
		<?php echo $form->labelEx($model,'nivelcuenta'); ?>
		<?php echo $form->textField($model,'nivelcuenta',array('size'=>2,'maxlength'=>2,'readonly'=>true)); ?>
		<?php echo $form->error($model,'nivelcuenta'); ?>
                <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nivelcuenta_tooltip','Parametros','PlanCuentasNec'),
			'effect' => 'normal'
                	));
                ?>
                <br>


		<?php echo $form->labelEx($model,'idcuentaniff'); ?>

        <?php

                echo CHtml::textField('nombrecuentaniff', Plancuentasniff::model()->buscaNombre($model->idcuentaniff), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la cuenta','javascript:escogerModelo();');

                echo $form->hiddenField($model,'idcuentaniff',array('size'=>30,'readonly'=>true));
                /*echo $form->dropDownList($model, 'idcuentaniff', CHtml::listData(
                    PlanCuentasNiff::model()->findAll(), 'idcuentaniff', 'concatened'),
                    array('prompt' => 'Selecciona la cuenta'));*/
        ?>
	<?php echo $form->error($model,'idcuentaniff'); ?>
	<?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idcuentaniff_tooltip','Parametros','PlanCuentasNec'),
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
			'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','PlanCuentasNec'),
			'effect' => 'normal'
                	));
                ?>
                <br>

    <?php
            $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
    ?>

<?php $this->endWidget(); ?>

<?php $this->widget('ModelosWidget', array(
	'id' => 'modelo_dlg',
	'nombre' => $model->cuentacontable,
	'selectCallback' => 'onSelectModelo',
    'title'=>'Seleccione Cuenta Contable Niff',
    'url_lista'=>'plancuentasniff/buscarAjaxCuentaNiff',
    'modelo'=>'Plancuentasnec',
    'obj_name'=>'nombrecuentaniff',
    'obj_fk'=>'idcuentaniff',
    'busqueda'=>'busquedaNiff',
));?>

<script type="text/javascript">
    function escogerModelo() {
            $("#modelo_dlg").dialog("open");
    }

    onSelectModelo = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#modelo_dlg").dialog("close");
    }

</script>