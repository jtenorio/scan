<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','Item'); ?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'codigoproducto'),
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),

)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

        <br>
		<?php echo $form->labelEx($model,'codigoproducto'); ?>
		<?php echo $form->textField($model,'codigoproducto',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'codigoproducto'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('codigoproducto_tooltip','Parametros','Item'),
			'effect' => 'normal'
	));
	?>
        <br>



		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'nombre'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombre_tooltip','Parametros','Item'),
			'effect' => 'normal'
	));
	?>
        <br>
<?php echo $form->labelEx($model,'tipoproducto'); ?>
		<?php echo $form->DropDownList($model,'tipoproducto',$tipos,'',array('change'=>'javascript:manejoPrecios();')); ?>
		<?php echo $form->error($model,'tipoproducto'); ?>
    <?php
            	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('tipoproducto_tooltip','Parametros','Item'),
			'effect' => 'normal'
	));
	?>
        <br>
        <h4>Valores</h4>
        <hr>
		<?php echo $form->labelEx($model,'stock'); ?>
		<?php echo $form->textField($model,'stock',array('size'=>10,'maxlength'=>10,'readonly'=>'true')); ?>
		<?php echo $form->error($model,'stock'); ?>
            <?php
            	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('stock_tooltip','Parametros','Item'),
			'effect' => 'normal'
                ));
	?>
        <br>
	<?php echo $form->labelEx($model,'stockminimo'); ?>
        <?php echo $form->textField($model,'stockminimo',array('size'=>10,'maxlength'=>10,'readonly'=>'true')); ?>
	<?php echo $form->error($model,'stockminimo'); ?>
	    <?php
            	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('stockminimo_tooltip','Parametros','Item'),
			'effect' => 'normal'
	));
	?>
        <br>


		<?php echo $form->labelEx($model,'costo'); ?>
		<?php echo $form->textField($model,'costo',array('size'=>10,'maxlength'=>10,'readonly'=>'true')); ?>
		<?php echo $form->error($model,'costo'); ?>
	    <?php
            	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('costo_tooltip','Parametros','Item'),
			'effect' => 'normal'
	));
	?>
        <br>
        <hr>
	<?php echo $form->labelEx($model,'idcategoria'); ?>
		<?php
                    echo CHtml::textField('nombrecategoria', Categoria::model()->buscaNombre($model->idcategoria), array('readonly'=>true,'size'=>'35'));
                echo $form->hiddenField($model,'idcategoria',array('size'=>40,'maxlength'=>40));
                   echo CHtml::link('Escoger la categoria','javascript:escogerCategoria();');
                ?>
		<?php echo $form->error($model,'idcategoria'); ?>
	        <?php
                $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idcategoria_tooltip','Parametros','Item'),
			'effect' => 'normal'
                ));
                ?>
        <br>



		<?php echo $form->labelEx($model,'idpresentacion'); ?>
		<?php
                echo CHtml::textField('nombrepresentacion', Presentacion::model()->buscaNombre($model->idpresentacion), array('readonly'=>true,'size'=>'35'));
                echo $form->hiddenField($model,'idpresentacion',array('size'=>40,'maxlength'=>40));
                   echo CHtml::link('Escoger la presentacion','javascript:escogerPresentacion();');
                 ?>
		<?php echo $form->error($model,'idpresentacion'); ?>
                <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idpresentacion_tooltip','Parametros','Item'),
			'effect' => 'normal'
	));
	?>
                <br>


		<?php echo $form->labelEx($model,'tarifaiva'); ?>
		<?php //echo $form->textField($model,'tarifaIva'); ?>
                <?php echo $form->DropDownList($model,'tarifaiva',$tarifas,array('empty'=>'--Seleccione una opcion--')); ?>
		<?php echo $form->error($model,'tarifaIva'); ?>
    <?php
            	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('tarifaiva_tooltip','Parametros','Item'),
			'effect' => 'normal'
	));
	?>
        <hr>
        <br>

		<?php echo $form->labelEx($model,'imagen'); ?>
		<?php echo CHtml::activeFileField($model, 'imagen');  ?>
                <?php echo CHtml::link('Ver la Imagen','javascript:abrirImagen();');?>
		<?php echo $form->error($model,'imagen'); ?>

        <?php
            	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('imagen_tooltip','Parametros','Item'),
			'effect' => 'normal'
	));
	?>

        <br>


		<?php //echo $form->labelEx($model,'preciopredefinido'); ?>
		<?php //echo $form->textField($model,'preciopredefinido',array('size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->error($model,'preciopredefinido'); ?>
    <?php
//            	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('preciopredefinido_tooltip','Parametros','Item'),
//			'effect' => 'normal'
//	));
	?>
        <br>


		<?php //echo $form->labelEx($model,'usarentipomovimiento');
                // Para los gastos se define value 1
                ?>
		<?php echo $form->hiddenField($model,'usarentipomovimiento',array('value'=>1)); ?>
		<?php echo $form->error($model,'usarentipomovimiento'); ?>
        <br>
        <h4>Cuentas Contables</h4>
        <hr>
		<?php echo $form->labelEx($model,'cuentacontablecompra'); ?>
		<?php
                echo CHtml::textField('nombrecuentacontablecompra', Plancuentasnec::model()->buscaNombre($model->cuentacontablecompra), array('readonly'=>true,'size'=>'35'));
                echo $form->hiddenField($model,'cuentacontablecompra',array('size'=>40,'maxlength'=>40));
                   echo CHtml::link('Escoger la Cuenta','javascript:escogerCompra();');

                 ?>
		<?php echo $form->error($model,'cuentacontablecompra'); ?>
    <?php
            	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontablecompra_tooltip','Parametros','Item'),
			'effect' => 'normal'
	));
	?>
        <!-- <br>-->


		<?php //echo $form->labelEx($model,'cuentacontableventa'); ?>
		<?php

                     //echo CHtml::textField('nombrecuentacontableventa', PlanCuentasNec::model()->buscaNombre($model->cuentacontableventa), array('readonly'=>true,'size'=>'35'));
                //echo $form->hiddenField($model,'cuentacontableventa',array('size'=>40,'maxlength'=>40));
                  // echo CHtml::link('Escoger la Cuenta','javascript:escogerVenta();');

               ?>
		<?php //echo $form->error($model,'cuentacontableventa'); ?>
    <?php
//            	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('cuentacontableventa_tooltip','Parametros','Item'),
//			'effect' => 'normal'
//	));
	?>
        <!-- <br>-->


		<?php //echo $form->labelEx($model,'cuentacontablecostoventa'); ?>
		<?php
                   //echo CHtml::textField('nombrecuentacontablecostoventa', PlanCuentasNec::model()->buscaNombre($model->cuentacontablecostoventa), array('readonly'=>true,'size'=>'35'));
                   //echo $form->hiddenField($model,'cuentacontablecostoventa',array('size'=>40,'maxlength'=>40));
                   //echo CHtml::link('Escoger la Cuenta','javascript:escogerCostoVenta();');

                 ?>
		<?php //echo $form->error($model,'cuentacontablecostoventa'); ?>
    <?php
//            	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('cuentacontablecostoventa_tooltip','Parametros','Item'),
//			'effect' => 'normal'
//	));
	?>
        <!-- <br>-->


		<?php //echo $form->labelEx($model,'cuentacontabledescuentoventa'); ?>
		<?php
//                         echo CHtml::textField('nombrecuentacontabledescuentoventa', PlanCuentasNec::model()->buscaNombre($model->cuentacontabledescuentoventa), array('readonly'=>true,'size'=>'35'));
//                   echo $form->hiddenField($model,'cuentacontabledescuentoventa',array('size'=>40,'maxlength'=>40));
//                   echo CHtml::link('Escoger la Cuenta','javascript:escogerDescuentoVenta();');


               ?>
		<?php //echo $form->error($model,'cuentacontabledescuentoventa'); ?>
    <?php
//            	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('cuentacontabledescuentoventa_tooltip','Parametros','Item'),
//			'effect' => 'normal'
//	));
	?>
        <!-- <br>-->


		<?php //echo $form->labelEx($model,'cuentacontabledevolucionventa'); ?>
		<?php

//                      echo CHtml::textField('nombrecuentacontabledevolucionventa', PlanCuentasNec::model()->buscaNombre($model->cuentacontabledevolucionventa), array('readonly'=>true,'size'=>'35'));
//                   echo $form->hiddenField($model,'cuentacontabledevolucionventa',array('size'=>40,'maxlength'=>40));
//                   echo CHtml::link('Escoger la Cuenta','javascript:escogerDevolucionVenta();');

                //echo $form->textField($model,'cuentacontabledevolucionventa'); ?>
		<?php //echo $form->error($model,'cuentacontabledevolucionventa'); ?>

    <?php
//            	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('cuentacontabledevolucionventa_tooltip','Parametros','Item'),
//			'effect' => 'normal'
//	));
	?>
        <br>

		<?php //echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->hiddenField($model,'estado',array('value'=>1)); ?>
		<?php //echo $form->error($model,'estado'); ?>
    <?php
//            	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('estado_tooltip','Parametros','Item'),
//			'effect' => 'normal'
//	));
	?>
 <!--<br>-->


		<?php echo $form->labelEx($model,'usatablaprecios'); ?>
		<?php echo $form->checkBox($model,'usatablaprecios'); ?>
		<?php echo $form->error($model,'usatablaprecios'); ?>
        <?php
            	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('usatablaprecios_tooltip','Parametros','Item'),
        		'effect' => 'normal'
	));
	?>
 <br>
       	<?php $this->renderPartial('application.modules.parametros.views.item.partes.tabla_precios',compact('tabla')); ?>
<br>

        <br>

        	<?php $this->renderPartial('application.modules.parametros.views.item.partes.custom_servicios',compact('model_cstm')); ?>
<br>
            <?php
                    $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
            ?>



<?php $this->endWidget(); ?>
<?php $this->widget('SelectorDatepickerWidget', FormatUtil::defaultDateOptions('fecha'));?>
        <?php $this->widget('ModelosWidget', array(
	'id' => 'categoria_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCategoria',
        'title'=>'Seleccione la Categoria',
        'url_lista'=>'categoria/buscarAjaxCategoria',
        'modelo'=>'Item',
        'obj_name'=>'nombrecategoria',
        'obj_fk'=>'idcategoria',
        'busqueda'=>'busquedaCategoria',



));?>

    <?php $this->widget('ModelosWidget', array(
	'id' => 'presentacion_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectPresentacion',
        'title'=>'Seleccione la Presentacion',
        'url_lista'=>'presentacion/buscarAjaxPresentacion',
        'modelo'=>'Item',
        'obj_name'=>'nombrepresentacion',
        'obj_fk'=>'idpresentacion',
        'busqueda'=>'busquedaPresentacion',



));?>
<?php
$this->widget('ModelosWidget', array(
	'id' => 'compra_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCompra',
        'title'=>'Seleccione Cuenta Contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Item',
        'obj_name'=>'nombrecuentacontablecompra',
        'obj_fk'=>'cuentacontablecompra',
        'busqueda'=>'busquedaCompra',


));
?>



<?php
//$this->widget('ModelosWidget', array(
//	'id' => 'costoventa_dlg',
//	'nombre' => '',
//	'selectCallback' => 'onSelectCostoVenta',
//        'title'=>'Seleccione Cuenta Contable',
//        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
//        'modelo'=>'Item',
//        'obj_name'=>'nombrecuentacontablecostoventa',
//        'obj_fk'=>'cuentacontablecostoventa',
//        'busqueda'=>'busquedaCostoVenta',
//
//
//));
?>

        <?php
//        $this->widget('ModelosWidget', array(
//	'id' => 'venta_dlg',
//	'nombre' => '',
//	'selectCallback' => 'onSelectVenta',
//        'title'=>'Seleccione Cuenta Contable',
//        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
//        'modelo'=>'Item',
//        'obj_name'=>'nombrecuentacontableventa',
//        'obj_fk'=>'cuentacontableventa',
//        'busqueda'=>'busquedaVenta',
//
//
//));
        ?>

<?php
//$this->widget('ModelosWidget', array(
//	'id' => 'descuentoventa_dlg',
//	'nombre' => '',
//	'selectCallback' => 'onSelectDescuentoVenta',
//        'title'=>'Seleccione Cuenta Contable',
//        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
//        'modelo'=>'Item',
//        'obj_name'=>'nombrecuentacontabledescuentoventa',
//        'obj_fk'=>'cuentacontabledescuentoventa',
//        'busqueda'=>'busquedaDescuentoVenta',
//
//
//));
?>



<?php
//$this->widget('ModelosWidget', array(
//	'id' => 'devolucionventa_dlg',
//	'nombre' => '',
//	'selectCallback' => 'onSelectDevolucionVenta',
//        'title'=>'Seleccione Cuenta Contable',
//        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
//        'modelo'=>'Item',
//        'obj_name'=>'nombrecuentacontabledevolucionventa',
//        'obj_fk'=>'cuentacontabledevolucionventa',
//        'busqueda'=>'busquedaDevolucionVenta',
//
//
//));?>



<?php      $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'imagen_dlg',
	'options'=>array(
		'title'=>'Imagen',
		'autoOpen'=>false,
		'modal'=>true,
		'width'=>500,
		'height'=>300
	),
));?>
        <?php if(is_array($data_imagen)): ?>
                    <img src="<?php echo Yii::app()->getRequest()->getBaseUrl(). $path.'/'.$data_imagen['imagen']?>" >
                <?php endif;?>
                    <br>
        <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<script type="text/javascript">
    function escogerCategoria() {

            $("#categoria_dlg").dialog("open");
    }



     onSelectCategoria= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#categoria_dlg").dialog("close");
    }


    function escogerPresentacion() {

            $("#presentacion_dlg").dialog("open");
    }

        function escogerCompra() {

            $("#compra_dlg").dialog("open");
    }
//    function escogerVenta() {
//
//            $("#venta_dlg").dialog("open");
//    }
//    function escogerCostoVenta() {
//
//            $("#costoventa_dlg").dialog("open");
//    }
//    function escogerDescuentoVenta() {
//
//            $("#descuentoventa_dlg").dialog("open");
//    }
//    function escogerDevolucionVenta() {
//
//            $("#devolucionventa_dlg").dialog("open");
//    }
//

    function abrirImagen() {

            $("#imagen_dlg").dialog("open");
    }


   onSelectPresentacion= function(fk,nombre,objfk,name){
           $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#presentacion_dlg").dialog("close");
    }
onSelectCompra= function(fk,nombre,objfk,name){
           $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#compra_dlg").dialog("close");
    }
//    onSelectVenta= function(fk,nombre,objfk,name){
//           $("#"+objfk).val(fk);
//            $("#"+name).val(nombre);
//            $("#venta_dlg").dialog("close");
//    }
//    onSelectCostoVenta= function(fk,nombre,objfk,name){
//           $("#"+objfk).val(fk);
//            $("#"+name).val(nombre);
//            $("#costoventa_dlg").dialog("close");
//    }
//    onSelectDescuentoVenta = function(fk,nombre,objfk,name){
//           $("#"+objfk).val(fk);
//            $("#"+name).val(nombre);
//            $("#descuentoventa_dlg").dialog("close");
//    }
//     onSelectDevolucionVenta = function(fk,nombre,objfk,name){
//           $("#"+objfk).val(fk);
//            $("#"+name).val(nombre);
//            $("#devolucionventa_dlg").dialog("close");
//    }
    function manejoPrecios(){
        if($("#Item_tipoproducto").val()==1){
         $("#Item_stock").attr("readonly",false);
            $("#Item_stockminimo").attr("readonly",false);
            $("#Item_costo").attr("readonly",false);
            $("#ItemCstm_idmodelo").attr("readonly",false);
            $("#ItemCstm_idmarca").attr("readonly",false);
            $("#ItemCstm_numeroserie").attr("readonly",false);
            $("#ItemCstm_ubicacion").attr("readonly",false);
            $("#ItemCstm_codigobarras").attr("readonly",false);
            $("#ItemCstm_estadoitemcalidad").attr("readonly",false);
                    $("#linkmarca").show();
            $("#linkmodelo").show();



        }else if($("#Item_tipoproducto").val()==2){
            $("#Item_stock").val("")
            $("#Item_stockminimo").val("")
            $("#Item_costo").val("")
            $("#Item_stock").attr("readonly",true);
            $("#Item_stockminimo").attr("readonly",true);
            $("#Item_costo").attr("readonly",true);
            $("#linkmarca").hide();
            $("#linkmodelo").hide();

            $("#nombremodelo").val("");
            $("#nombremarca").val("");
            $("#ItemCstm_idmodelo").val("")
            $("#ItemCstm_idmarca").val("")
            $("#ItemCstm_numeroserie").val("")
            $("#ItemCstm_ubicacion").val("")
            $("#ItemCstm_codigobarras").val("")
            $("#ItemCstm_estadoitemcalidad").val("")

            $("#ItemCstm_idmodelo").attr("readonly",true);
            $("#ItemCstm_idmarca").attr("readonly",true);
            $("#ItemCstm_numeroserie").attr("readonly",true);
            $("#ItemCstm_ubicacion").attr("readonly",true);
            $("#ItemCstm_codigobarras").attr("readonly",true);
            $("#ItemCstm_estadoitemcalidad").attr("readonly",true);

        }

    }
$(document).ready(function() {

    $("#Item_tipoproducto").change(function(){
        manejoPrecios();
    });
});
</script>