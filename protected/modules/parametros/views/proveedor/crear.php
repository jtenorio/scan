<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','Proveedor'); ?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'proveedor-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'cedularuc'),

)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
<?php echo CHtml::hiddenField('scenario', 'insert')?>
	<?php echo $form->errorSummary($model); ?>
        <br>

	
		<?php echo $form->labelEx($model,'cedularuc'); ?>
		<?php echo $form->textField($model,'cedularuc',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'cedularuc'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cedularuc_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'razonsocial'); ?>
		<?php echo $form->textField($model,'razonsocial',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'razonsocial'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('razonsocial_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>


	
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('direccion_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('telefono_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fax'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('fax_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'ciudad'); ?>
		<?php echo $form->textField($model,'ciudad',array('readonly'=>true)); ?>
                <?php echo CHtml::link('Escoger la Ciudad','javascript:escogeCiudad();'); ?>
		<?php echo $form->error($model,'ciudad'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('ciudad_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'email'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('email_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>
	<?php echo $form->labelEx($model,'tipodocumento'); ?>
	<?php //echo $form->textField($model,'tipodocumento'); ?>
        <?php echo $form->dropDownList($model, 'tipodocumento', CHtml::listData(
                    Secuencialtransaccion::model()->findAll(array('order'=>' "id" ', 'condition'=>' "modulousarse" =:x', 'params'=>array(':x'=>1))), 'id', 'nombre'),array('prompt' => 'Selecciona el Tipo Documento'));
                ?>
		<?php echo $form->error($model,'tipodocumento'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('tipodocumento_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'contacto'); ?>
		<?php echo $form->textField($model,'contacto',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'contacto'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('contacto_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'nota1'); ?>
		<?php echo $form->textField($model,'nota1',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'nota1'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nota1_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'nota2'); ?>
		<?php echo $form->textField($model,'nota2',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'nota2'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nota2_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>

	
		<?php echo $form->labelEx($model,'saldo'); ?>
		<?php echo $form->textField($model,'saldo',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'saldo'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('saldo_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>


		<?php echo $form->labelEx($model,'cuentacontableporpagar'); ?>
		<?php //echo $form->textField($model,'cuentacontableporpagar'); ?>
                <?php
                echo CHtml::textField('nombrecuentaporpagar', Plancuentasnec::model()->buscaNombre($model->cuentacontableporpagar), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la Cuenta','javascript:escogePorPagar();');

                echo $form->hiddenField($model,'cuentacontableporpagar',array('size'=>30,'readonly'=>true));

//                   echo $form->dropDownList($model, 'cuentacontableporpagar', CHtml::listData(
//                    PlanCuentasNec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta por pagar'));
                ?>
		<?php echo $form->error($model,'cuentacontableporpagar'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontableporpagar_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>


		<?php echo $form->labelEx($model,'cuentacontableanticipo'); ?>
		<?php //echo $form->textField($model,'cuentacontableanticipo'); ?>
                 <?php

                 echo CHtml::textField('nombrecuentaanticipo', Plancuentasnec::model()->buscaNombre($model->cuentacontableanticipo), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la Cuenta','javascript:escogeAnticipo();');
                echo $form->hiddenField($model,'cuentacontableanticipo',array('size'=>30,'readonly'=>true));

//                 echo $form->dropDownList($model, 'cuentacontableanticipo', CHtml::listData(
//                    PlanCuentasNec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta de Anticipo'));
                ?>
		<?php echo $form->error($model,'cuentacontableanticipo'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontableanticipo_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>


		<?php echo $form->labelEx($model,'autorizacionfactura'); ?>
		<?php echo $form->textField($model,'autorizacionfactura',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'autorizacionfactura'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('autorizacionfactura_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>



		<?php echo $form->labelEx($model,'fechacaducidad'); ?>
		<?php echo $form->textField($model,'fechacaducidad',array('class'=>'fecha')); ?>
		<?php echo $form->error($model,'fechacaducidad'); ?>
            <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('fechacaducidad_tooltip','Parametros','Proveedor'),
			'effect' => 'normal'
	));
	?>

	<br>



		<?php echo $form->labelEx($model,'idtipoproveedor'); ?>
		<?php //echo $form->textField($model,'idtipoproveedor'); ?>
                <?php echo $form->dropDownList($model, 'idtipoproveedor', CHtml::listData(
                    Tipoproveedor::model()->findAll(), 'id', 'nombre'),array('prompt' => 'Selecciona el Tipo Proveedor'));
                ?>
		<?php echo $form->error($model,'idtipoproveedor'); ?>


	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idtipoproveedor_tooltip','Parametros','Proveedor'),
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
	'id' => 'anticipo_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectAnticipo',
        'title'=>'Seleccione Cuenta Contable Anticipo',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Proveedor',
        'obj_name'=>'nombrecuentaanticipo',
        'obj_fk'=>'cuentacontableanticipo',
        'busqueda'=>'busquedaCuentaAnticipo',
));?>


<?php $this->widget('ModelosWidget', array(
	'id' => 'porpagar_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectPorPagar',
        'title'=>'Seleccione Cuenta Contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Proveedor',
        'obj_name'=>'nombrecuentaporpagar',
        'obj_fk'=>'cuentacontableporpagar',
        'busqueda'=>'busquedaCuentaPorPagar',




));?>

<?php $this->widget('ModelosWidget', array(
	'id' => 'ciudad_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCiudad',
        'title'=>'Seleccione la ciudad',
        'url_lista'=>'catalogos/CiudadAjax',
        'modelo'=>'Proveedor',
        'obj_name'=>'ciudad',
        'obj_fk'=>'ciudad_fx',
        'busqueda'=>'busquedaCiudad',
));?>


<script type="text/javascript">
    function escogeAnticipo() {

            $("#anticipo_dlg").dialog("open");
    }

    function escogeCiudad() {

            $("#ciudad_dlg").dialog("open");
    }

  function escogePorPagar() {

            $("#porpagar_dlg").dialog("open");
    }

  

    onSelectAnticipo = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#anticipo_dlg").dialog("close");
    }

     onSelectPorPagar= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#porpagar_dlg").dialog("close");
    }

 onSelectCiudad= function(fk,nombre,objfk,name){
            
            
            $("#"+objfk).val(nombre);
            $("#"+name).val(fk);
            $("#ciudad_dlg").dialog("close");
    }
</script>