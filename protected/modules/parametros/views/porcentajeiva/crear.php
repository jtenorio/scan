<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','PorcentajeIva'); ?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'porcentaje-iva-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'codigo'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
        <?php echo CHtml::hiddenField('scenario', 'insert')?>
	<?php echo $form->errorSummary($model); ?>

	
		<?php echo $form->labelEx($model,'porcentaje'); ?>
		<?php echo $form->textField($model,'porcentaje',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'porcentaje'); ?>
        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('porcentaje_tooltip','Parametros','PorcentajeIva'),
			'effect' => 'normal'
        	));
            ?>
	<br>

	
		<?php echo $form->labelEx($model,'vigentedesde'); ?>
		<?php echo $form->textField($model,'vigentedesde',array('class'=>'fecha')); ?>
		<?php echo $form->error($model,'vigentedesde'); ?>
	<?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('vigentedesde_tooltip','Parametros','PorcentajeIva'),
			'effect' => 'normal'
        	));
            ?>

        <br>

	
		<?php echo $form->labelEx($model,'vigentehasta'); ?>
		<?php echo $form->textField($model,'vigentehasta',array('class'=>'fecha')); ?>
		<?php echo $form->error($model,'vigentehasta'); ?>
        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('vigentehasta_tooltip','Parametros','PorcentajeIva'),
			'effect' => 'normal'
        	));
            ?>

	<br>

	
		<?php echo $form->labelEx($model,'cuentacontablecredito'); ?>
		<?php //echo $form->textField($model,'cuentacontablecredito'); ?>
                           <?php
                echo CHtml::textField('nombrecuentacredito', Plancuentasnec::model()->buscaNombre($model->cuentacontablecredito), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la Cuenta','javascript:escogeCredito();');

                echo $form->hiddenField($model,'cuentacontablecredito',array('size'=>30,'readonly'=>true));


                           ////echo $form->dropDownList($model, 'cuentacontablecredito', CHtml::listData(
//                    PlanCuentasNec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta Credito'));
                ?>

		<?php echo $form->error($model,'cuentacontablecredito'); ?>
        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontablecredito_tooltip','Parametros','PorcentajeIva'),
			'effect' => 'normal'
        	));
            ?>

	<br>

	
		<?php echo $form->labelEx($model,'cuentacontablegasto'); ?>
		<?php //echo $form->textField($model,'cuentacontablegasto'); ?>
                   <?php
                echo CHtml::textField('nombrecuentagasto', Plancuentasnec::model()->buscaNombre($model->cuentacontablegasto), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la Cuenta','javascript:escogeGasto();');

                echo $form->hiddenField($model,'cuentacontablegasto',array('size'=>30,'readonly'=>true));

                   ////echo $form->dropDownList($model, 'cuentacontablegasto', CHtml::listData(
                    //PlanCuentasNec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta Gasto'));
                ?>
		<?php echo $form->error($model,'cuentacontablegasto'); ?>
	<?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontablegasto_tooltip','Parametros','PorcentajeIva'),
			'effect' => 'normal'
        	));
            ?>
        <br>

	
		<?php echo $form->labelEx($model,'cuentacontableventa'); ?>
		<?php //echo $form->textField($model,'cuentacontableventa'); ?>
                 <?php

            echo CHtml::textField('nombrecuentaventa', Plancuentasnec::model()->buscaNombre($model->cuentacontableventa), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la Cuenta','javascript:escogeVenta();');

                echo $form->hiddenField($model,'cuentacontableventa',array('size'=>30,'readonly'=>true));

//echo $form->dropDownList($model, 'cuentacontableventa', CHtml::listData(
                    //PlanCuentasNec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta Venta'));
                ?>
		<?php echo $form->error($model,'cuentacontableventa'); ?>
	<?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontableventa_tooltip','Parametros','PorcentajeIva'),
			'effect' => 'normal'
        	));
            ?>
        <br>

	
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
            <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('descripcion_tooltip','Parametros','PorcentajeIva'),
			'effect' => 'normal'
        	));
            ?>
	<br>
    <?php
        $this->widget('BotonesWidget',array('permitidos'=>array('save','delete','exit')));
    ?>

    <?php $this->endWidget(); ?>
<?php $this->widget('SelectorDatepickerWidget', FormatUtil::defaultDateOptions('fecha'));?>


<?php $this->widget('ModelosWidget', array(
	'id' => 'credito_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCredito',
        'title'=>'Seleccione Cuenta Contable Credito',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Porcentajeiva',
        'obj_name'=>'nombrecuentacredito',
        'obj_fk'=>'cuentacontablecredito',
        'busqueda'=>'busquedaCuentaCredito',
));?>


<?php $this->widget('ModelosWidget', array(
	'id' => 'gasto_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectGasto',
        'title'=>'Seleccione Cuenta Contable Gasto',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Porcentajeiva',
        'obj_name'=>'nombrecuentagasto',
        'obj_fk'=>'cuentacontablegasto',
        'busqueda'=>'busquedaCuentaGasto',




));?>


<?php $this->widget('ModelosWidget', array(
	'id' => 'venta_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectVenta',
        'title'=>'Seleccione Cuenta Contable Ventas',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Porcentajeiva',
        'obj_name'=>'nombrecuentaventa',
        'obj_fk'=>'cuentacontableventa',
        'busqueda'=>'busquedaCuentaVenta',




));?>

<script type="text/javascript">
    function escogeCredito() {

            $("#credito_dlg").dialog("open");
    }

  function escogeVenta() {

            $("#venta_dlg").dialog("open");
    }

  function escogeGasto() {

            $("#gasto_dlg").dialog("open");
    }


    onSelectCredito = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#credito_dlg").dialog("close");
    }

     onSelectGasto= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#gasto_dlg").dialog("close");
    }

onSelectVenta= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#venta_dlg").dialog("close");
    }
</script>