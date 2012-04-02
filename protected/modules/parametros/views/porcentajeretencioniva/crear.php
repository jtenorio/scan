<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','PorcentajeRetencionIva'); ?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'porcentaje-retencion-iva-form',
	'enableAjaxValidation'=>false,
         'enableClientValidation'=>false,
        'focus'=>array($model,'codigo'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
        <?php echo CHtml::hiddenField('scenario', 'insert')?>
	<?php echo $form->errorSummary($model); ?>
        <br>
	
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'codigo'); ?>
                <?php
                    $this->widget('HintWidget', array(
                                    'text' =>MessageHandler::transformar('codigo_tooltip','Parametros','PorcentajeRetencionIva'),
                                    'effect' => 'normal'
                    ));
        	?>
            <br>

	
		<?php echo $form->labelEx($model,'porcentaje'); ?>
		<?php echo $form->textField($model,'porcentaje',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'porcentaje'); ?>
                <?php
                    $this->widget('HintWidget', array(
                                    'text' =>MessageHandler::transformar('porcentaje_tooltip','Parametros','PorcentajeRetencionIva'),
                                    'effect' => 'normal'
                    ));
                 ?>
            <br>

	
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
                <?php
                    $this->widget('HintWidget', array(
                                    'text' =>MessageHandler::transformar('descripcion_tooltip','Parametros','PorcentajeRetencionIva'),
                                    'effect' => 'normal'
                    ));
        	?>
            <br>

	
		<?php echo $form->labelEx($model,'cuentacontablecompra'); ?>
        <?php
        echo CHtml::textField('nombrecuentacompra', Plancuentasnec::model()->buscaNombre($model->cuentacontablecompra), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la Cuenta','javascript:escogeCompra();');

                echo $form->hiddenField($model,'cuentacontablecompra',array('size'=>30,'readonly'=>true));
//        echo $form->dropDownList($model, 'cuentacontablecompra', CHtml::listData(
//                    PlanCuentasNec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta'));
        ?>
		<?php //echo $form->textField($model,'cuentacontablecompra'); ?>
		<?php echo $form->error($model,'cuentacontablecompra'); ?>
	<?php
                    $this->widget('HintWidget', array(
                                    'text' =>MessageHandler::transformar('cuentacontablecompra_tooltip','Parametros','PorcentajeRetencionIva'),
                                    'effect' => 'normal'
                    ));
        	?>
            <br>

	
		<?php echo $form->labelEx($model,'cuentacontableventa'); ?>
        <?php
                    echo CHtml::textField('nombrecuentaventa', Plancuentasnec::model()->buscaNombre($model->cuentacontableventa), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la Cuenta','javascript:escogeVenta();');

                echo $form->hiddenField($model,'cuentacontableventa',array('size'=>30,'readonly'=>true));


//        echo $form->dropDownList($model, 'cuentacontableventa', CHtml::listData(
//                    PlanCuentasNec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta'));
        ?>
		<?php //echo $form->textField($model,'cuentacontableventa'); ?>
		<?php echo $form->error($model,'cuentacontableventa'); ?>
                <?php
                    $this->widget('HintWidget', array(
                                    'text' =>MessageHandler::transformar('cuentacontableventa_tooltip','Parametros','PorcentajeRetencionIva'),
                                    'effect' => 'normal'
                    ));
        	?>
            <br>


	
		<?php echo $form->labelEx($model,'idempresa'); ?>
                <?php echo $form->dropDownList($model, 'idempresa',CHtml::listData(
                    Empresa::model()->findAll(), 'idempresa', 'razonsocial'));?>

		<?php //echo $form->textField($model,'idempresa'); ?>
		<?php echo $form->error($model,'idempresa'); ?>
	<?php
                    $this->widget('HintWidget', array(
                                    'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','PorcentajeRetencionIva'),
                                    'effect' => 'normal'
                    ));
        	?>
            <br>

	    
    <?php
        $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
    ?>

    <?php $this->endWidget(); ?>

  <?php $this->widget('ModelosWidget', array(
	'id' => 'compra_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCompra',
        'title'=>'Seleccione Cuenta Contable Compra',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Porcentajeretencioniva',
        'obj_name'=>'nombrecuentacompra',
        'obj_fk'=>'cuentacontablecompra',
        'busqueda'=>'busquedaCuentaCompra',
));?>




<?php $this->widget('ModelosWidget', array(
	'id' => 'venta_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectVenta',
        'title'=>'Seleccione Cuenta Contable Ventas',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Porcentajeretencioniva',
        'obj_name'=>'nombrecuentaventa',
        'obj_fk'=>'cuentacontableventa',
        'busqueda'=>'busquedaCuentaVenta',




));?>

<script type="text/javascript">
    function escogeCompra() {
            $("#compra_dlg").dialog("open");
    }

  function escogeVenta() {
            $("#venta_dlg").dialog("open");
  }



    onSelectCompra = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#compra_dlg").dialog("close");
    }

    

onSelectVenta= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#venta_dlg").dialog("close");
    }
</script>

