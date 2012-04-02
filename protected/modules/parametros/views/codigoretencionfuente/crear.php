<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','CodigoRetencionFuente'); ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'codigo-retencion-fuente-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
          'focus'=>array($model,'codigo'),
));  ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

        <br>
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'codigo'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('codigo_tooltip','Parametros','CodigoRetencionFuente'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('descripcion_tooltip','Parametros','CodigoRetencionFuente'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'porcentaje'); ?>
			<?php echo $form->textField($model,'porcentaje',array('size'=>60,'maxlength'=>80)); ?>
                <?php //echo $form->dropDownList($model, 'porcentaje', CHtml::listData(
//                     PorcentajeRetencionFuente::model()->findAll(), 'id', 'porcentaje'),array('prompt' => 'Selecciona los '));
        ?>

		<?php echo $form->error($model,'porcentaje'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('porcentaje_tooltip','Parametros','CodigoRetencionFuente'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'vigentedesde'); ?>
		<?php echo $form->textField($model,'vigentedesde',array('class'=>'fecha')); ?>
		<?php echo $form->error($model,'vigentedesde'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('vigentedesde_tooltip','Parametros','CodigoRetencionFuente'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'vigentehasta'); ?>
		<?php echo $form->textField($model,'vigentehasta',array('class'=>'fecha')); ?>
		<?php echo $form->error($model,'vigentehasta'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('vigentehasta_tooltip','Parametros','CodigoRetencionFuente'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'pormil'); ?>
		<?php echo $form->checkBox($model,'pormil'); ?>
		<?php echo $form->error($model,'pormil'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('pormil_tooltip','Parametros','CodigoRetencionFuente'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'cuentacontablecompras'); ?>
		
                 <?php

                 echo CHtml::textField('nombrecuentacontablecompras', Plancuentasnec::model()->buscaNombre($model->cuentacontablecompras), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la cuenta','javascript:escogerCompra();');

                echo $form->hiddenField($model,'cuentacontablecompras',array('size'=>30,'readonly'=>true));

                // echo $form->dropDownList($model, 'cuentacontablecompras', CHtml::listData(
                  //  Plancuentasnec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta'));
        ?>
		<?php echo $form->error($model,'cuentacontablecompras'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontablecompras_tooltip','Parametros','CodigoRetencionFuente'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'cuentacontableventas'); ?>
		
        <?php

        echo CHtml::textField('nombrecuentacontableventas', Plancuentasnec::model()->buscaNombre($model->cuentacontableventas), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la cuenta','javascript:escogerVenta();');

                echo $form->hiddenField($model,'cuentacontableventas',array('size'=>30,'readonly'=>true));


        //echo $form->dropDownList($model, '', CHtml::listData(
          //          Plancuentasnec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta'));
        ?>
		<?php echo $form->error($model,'cuentacontableventas'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontableventas_tooltip','Parametros','CodigoRetencionFuente'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'idcodigoporcentaje'); ?>
                <?php echo $form->dropDownList($model, 'idcodigoporcentaje', CHtml::listData(
                    Porcentajeretencionfuente::model()->findAll(array('order'=>'porcentaje')), 'id', 'porcentaje'),array('prompt' => 'Selecciona el porcentaje'));
                ?>
		<?php echo $form->error($model,'idcodigoporcentaje'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idcodigoporcentaje_tooltip','Parametros','CodigoRetencionFuente'),
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
	'id' => 'compra_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCompra',
        'title'=>'Seleccione Cuenta Contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Codigoretencionfuente',
        'obj_name'=>'nombrecuentacontablecompras',
        'obj_fk'=>'cuentacontablecompras',
        'busqueda'=>'busquedaCompra',


));?>


<?php $this->widget('ModelosWidget', array(
	'id' => 'venta_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectVenta',
        'title'=>'Seleccione la cuenta Contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Codigoretencionfuente',
        'obj_name'=>'nombrecuentacontableventas',
        'obj_fk'=>'cuentacontableventas',
        'busqueda'=>'busquedaVenta',



));?>


<script type="text/javascript">
    function escogerCompra() {

            $("#compra_dlg").dialog("open");
    }

  function escogerVenta() {

            $("#venta_dlg").dialog("open");
    }


    onSelectVenta = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#venta_dlg").dialog("close");
    }

     onSelectCompra= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#compra_dlg").dialog("close");
    }

</script>