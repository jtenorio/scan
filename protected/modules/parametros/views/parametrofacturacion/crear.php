<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','ParametroFacturacion'); ?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parametro-facturacion-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
        'focus'=>array($model,'cuentacaja'),
)); ?>

	<p class="note">Campos <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>


        	<?php echo $form->labelEx($model,'cuentacaja'); ?>
		<?php

                  echo CHtml::textField('nombrecuentacaja', Plancuentasnec::model()->buscaNombre($model->cuentacaja), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerCaja();');
                  echo $form->hiddenField($model,'cuentacaja',array('size'=>30,'readonly'=>true));



                 ?>
		<?php echo $form->error($model,'cuentacaja'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacaja_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>


		<?php echo $form->labelEx($model,'cuentaventasdoce'); ?>
		<?php
                  echo CHtml::textField('nombrecuentaventasdoce', Plancuentasnec::model()->buscaNombre($model->cuentaventasdoce), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerVentasDoce();');
                  echo $form->hiddenField($model,'cuentaventasdoce',array('size'=>30,'readonly'=>true));

                //echo $form->textField($model,'cuentaventasdoce'); ?>
		<?php echo $form->error($model,'cuentaventasdoce'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentaventasdoce_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>


		<?php echo $form->labelEx($model,'cuentaventascero'); ?>
		<?php
                  echo CHtml::textField('nombrecuentaventascero', Plancuentasnec::model()->buscaNombre($model->cuentaventascero), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerVentasCero();');
                  echo $form->hiddenField($model,'cuentaventascero',array('size'=>30,'readonly'=>true));


                //echo $form->textField($model,'cuentaventascero'); ?>
		<?php echo $form->error($model,'cuentaventascero'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentaventascero_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentaivaventas'); ?>
		<?php
                echo CHtml::textField('nombrecuentaivaventas', Plancuentasnec::model()->buscaNombre($model->cuentaivaventas), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerIvaVentas();');
                  echo $form->hiddenField($model,'cuentaivaventas',array('size'=>30,'readonly'=>true));

                //echo $form->textField($model,'cuentaivaventas'); ?>
		<?php echo $form->error($model,'cuentaivaventas'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentaivaventas_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentadescuentoventas'); ?>
		<?php
                  echo CHtml::textField('nombrecuentadescuentoventas', Plancuentasnec::model()->buscaNombre($model->cuentadescuentoventas), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerDescuentoVentas();');
                  echo $form->hiddenField($model,'cuentadescuentoventas',array('size'=>30,'readonly'=>true));



                //echo $form->textField($model,'cuentadescuentoventas'); ?>
		<?php echo $form->error($model,'cuentadescuentoventas'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentadescuentoventas_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentaretfuenteventa'); ?>
		<?php
                     echo CHtml::textField('nombrecuentaretfuenteventa', Plancuentasnec::model()->buscaNombre($model->cuentaretfuenteventa), array('readonly'=>true,'size'=>'35'));
                     echo CHtml::link('Escoger la cuenta','javascript:escogerRetFuenteVentas();');
                     echo $form->hiddenField($model,'cuentaretfuenteventa',array('size'=>30,'readonly'=>true));


                //echo $form->textField($model,'cuentaretfuenteventa'); ?>
		<?php echo $form->error($model,'cuentaretfuenteventa'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentaretfuenteventa_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentaretivaventa'); ?>
		<?php
                  echo CHtml::textField('nombrecuentaretivaventa', Plancuentasnec::model()->buscaNombre($model->cuentaretivaventa), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerRetIvaVentas();');
                  echo $form->hiddenField($model,'cuentaretivaventa',array('size'=>30,'readonly'=>true));


                //echo $form->textField($model,'cuentaretivaventa');
                ?>
		<?php echo $form->error($model,'cuentaretivaventa'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentaretivaventa_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentaporcobrarcliente'); ?>
		<?php
                  echo CHtml::textField('nombrecuentaporcobrarcliente', Plancuentasnec::model()->buscaNombre($model->cuentaporcobrarcliente), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerCobrarCliente();');
                  echo $form->hiddenField($model,'cuentaporcobrarcliente',array('size'=>30,'readonly'=>true));


                //echo $form->textField($model,'cuentaporcobrarcliente'); ?>
		<?php echo $form->error($model,'cuentaporcobrarcliente'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentaporcobrarcliente_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>


		<?php echo $form->labelEx($model,'cuentareembolsocliente'); ?>
		<?php
                  echo CHtml::textField('nombrecuentareembolsocliente', Plancuentasnec::model()->buscaNombre($model->cuentareembolsocliente), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerReembolsoCliente();');
                  echo $form->hiddenField($model,'cuentareembolsocliente',array('size'=>30,'readonly'=>true));


                //echo $form->textField($model,'cuentareembolsocliente'); ?>
		<?php echo $form->error($model,'cuentareembolsocliente'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentareembolsocliente_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentacomprasdoce'); ?>
		<?php
                echo CHtml::textField('nombrecuentacomprasdoce', Plancuentasnec::model()->buscaNombre($model->cuentacomprasdoce), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerComprasDoce();');
                  echo $form->hiddenField($model,'cuentacomprasdoce',array('size'=>30,'readonly'=>true));

                //echo $form->textField($model,'cuentacomprasdoce'); ?>
		<?php echo $form->error($model,'cuentacomprasdoce'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacomprasdoce_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentacomprascero'); ?>
		<?php
                echo CHtml::textField('nombrecuentacomprascero', Plancuentasnec::model()->buscaNombre($model->cuentacomprascero), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerComprasCero();');
                  echo $form->hiddenField($model,'cuentacomprascero',array('size'=>30,'readonly'=>true));


               // echo $form->textField($model,'cuentacomprascero'); ?>
		<?php echo $form->error($model,'cuentacomprascero'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacomprascero_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentadescuentocompra'); ?>
		<?php
                  echo CHtml::textField('nombrecuentadescuentocompra', Plancuentasnec::model()->buscaNombre($model->cuentadescuentocompra), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerDescuentoCompra();');
                  echo $form->hiddenField($model,'cuentadescuentocompra',array('size'=>30,'readonly'=>true));

                //echo $form->textField($model,'cuentadescuentocompra'); ?>
		<?php echo $form->error($model,'cuentadescuentocompra'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentadescuentocompra_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentaivacompras'); ?>
		<?php
                  echo CHtml::textField('nombrecuentaivacompras', Plancuentasnec::model()->buscaNombre($model->cuentaivacompras), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerIvaCompra();');
                  echo $form->hiddenField($model,'cuentaivacompras',array('size'=>30,'readonly'=>true));

                //echo $form->textField($model,'cuentaivacompras'); ?>
		<?php echo $form->error($model,'cuentaivacompras'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentaivacompras_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>

		<?php echo $form->labelEx($model,'cuentaporpagarproveedor'); ?>
		<?php


                  echo CHtml::textField('nombrecuentaporpagarproveedor', Plancuentasnec::model()->buscaNombre($model->cuentaporpagarproveedor), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerPagarProveedor();');
                  echo $form->hiddenField($model,'cuentaporpagarproveedor',array('size'=>30,'readonly'=>true));

                //echo $form->textField($model,'cuentaporpagarproveedor'); ?>
		<?php echo $form->error($model,'cuentaporpagarproveedor'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentaporpagarproveedor_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'cuentaanticipoproveedor'); ?>
		<?php

                  echo CHtml::textField('nombrecuentaanticipoproveedor', Plancuentasnec::model()->buscaNombre($model->cuentaanticipoproveedor), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerAnticipoProveedor();');
                  echo $form->hiddenField($model,'cuentaanticipoproveedor',array('size'=>30,'readonly'=>true));


                //cho $form->textField($model,'cuentaanticipoproveedor'); ?>
		<?php echo $form->error($model,'cuentaanticipoproveedor'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentaanticipoproveedor_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>

        <br>
		<?php echo $form->labelEx($model,'numerocompra'); ?>
		<?php echo $form->textField($model,'numerocompra',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'numerocompra'); ?>
       <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('numerocompra_tooltip','Parametros','ParametroFacturacion'),
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
			'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','ParametroFacturacion'),
			'effect' => 'normal'
	));
        ?>
        <br>
	<?php
                  $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
         ?>

<?php $this->endWidget(); ?>







<?php $this->widget('ModelosWidget', array(
	'id' => 'caja_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCaja',
        'title'=>'Seleccione Cuenta Contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentacaja',
        'obj_fk'=>'cuentacaja',
        'busqueda'=>'busquedaCaja',


));?>


<?php $this->widget('ModelosWidget', array(
	'id' => 'ventasdoce_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectVentasDoce',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentaventasdoce',
        'obj_fk'=>'cuentaventasdoce',
        'busqueda'=>'busquedaVentasDoce',



));?>

<?php $this->widget('ModelosWidget', array(
	'id' => 'ventascero_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectVentasCero',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentaventascero',
        'obj_fk'=>'cuentaventascero',
        'busqueda'=>'busquedaVentasCero',



));?>


        <?php $this->widget('ModelosWidget', array(
	'id' => 'ivaventas_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectIvaVentas',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentaivaventas',
        'obj_fk'=>'cuentaivaventas',
        'busqueda'=>'busquedaIvaVentas',
));
        ?>


            <?php $this->widget('ModelosWidget', array(
	'id' => 'descuentoventas_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectDescuentoVentas',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentadescuentoventas',
        'obj_fk'=>'cuentadescuentoventas',
        'busqueda'=>'busquedaDescuentoVentas',
));
        ?>


<?php
$this->widget('ModelosWidget', array(
	'id' => 'retfuentesventas_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectRetFuenteVentas',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentaretfuenteventa',
        'obj_fk'=>'cuentaretfuenteventa',
        'busqueda'=>'busquedaRetFuenteVentas',
));
        ?>


<?php $this->widget('ModelosWidget', array(
	'id' => 'retivaventas_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectRetIvaVentas',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentaretivaventa',
        'obj_fk'=>'cuentaretivaventa',
        'busqueda'=>'busquedaRetIvaVentas',
));
        ?>

<?php
$this->widget('ModelosWidget', array(
	'id' => 'cobrarcliente_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCobrarCliente',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentaporcobrarcliente',
        'obj_fk'=>'cuentaporcobrarcliente',
        'busqueda'=>'busquedaCobrarCliente',
));
        ?>




<?php
$this->widget('ModelosWidget', array(
	'id' => 'reembolsocliente_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectReembolsoCliente',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentareembolsocliente',
        'obj_fk'=>'cuentareembolsocliente',
        'busqueda'=>'busquedaReembolsoCliente',
));
        ?>




        <?php
$this->widget('ModelosWidget', array(
	'id' => 'comprasdoce_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectComprasDoce',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentacomprasdoce',
        'obj_fk'=>'cuentacomprasdoce',
        'busqueda'=>'busquedaReembolsoCliente',
));
        ?>




<?php
$this->widget('ModelosWidget', array(
	'id' => 'comprascero_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectComprasCero',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentacomprascero',
        'obj_fk'=>'cuentacomprascero',
        'busqueda'=>'busquedaReembolsoCliente',
));
        ?>



        <?php
$this->widget('ModelosWidget', array(
	'id' => 'descuentocompra_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectDescuentoCompra',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentadescuentocompra',
        'obj_fk'=>'cuentadescuentocompra',
        'busqueda'=>'busquedaDescuentoCompra',
));
        ?>

<?php
        $this->widget('ModelosWidget', array(
	'id' => 'ivacompra_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectIvaCompra',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentaivacompras',
        'obj_fk'=>'cuentaivacompras',
        'busqueda'=>'busquedaIvaCompra',
));
        ?>



<?php
        $this->widget('ModelosWidget', array(
	'id' => 'pagarproveedor_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectPagarProveedor',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentaporpagarproveedor',
        'obj_fk'=>'cuentaporpagarproveedor',
        'busqueda'=>'busquedaPagarProveedor',
));
        ?>


<?php
        $this->widget('ModelosWidget', array(
	'id' => 'anticipoproveedor_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectAnticipoProveedor',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrofacturacion',
        'obj_name'=>'nombrecuentaanticipoproveedor',
        'obj_fk'=>'cuentaanticipoproveedor',
        'busqueda'=>'busquedaAnticipoProveedor',
));
        ?>
<script type="text/javascript">
    function escogerCaja() {

            $("#caja_dlg").dialog("open");
    }

  function escogerVentasDoce() {

            $("#ventasdoce_dlg").dialog("open");
    }


function escogerVentasCero() {
    $("#ventascero_dlg").dialog("open");
}

function escogerIvaVentas() {

            $("#ivaventas_dlg").dialog("open");
    }
function escogerDescuentoVentas() {

            $("#descuentoventas_dlg").dialog("open");
    }


function escogerRetFuenteVentas() {

            $("#retfuentesventas_dlg").dialog("open");
    }

function escogerRetIvaVentas() {

            $("#retivaventas_dlg").dialog("open");
    }
function escogerCobrarCliente() {

            $("#cobrarcliente_dlg").dialog("open");
    }
    function escogerReembolsoCliente() {

            $("#reembolsocliente_dlg").dialog("open");
    }


    function escogerComprasDoce() {

            $("#comprasdoce_dlg").dialog("open");
    }

    function escogerComprasCero() {
            $("#comprascero_dlg").dialog("open");
    }



    function escogerDescuentoCompra() {
            $("#descuentocompra_dlg").dialog("open");
    }

    function escogerIvaCompra(){
        $("#ivacompra_dlg").dialog("open");
    }

     function escogerPagarProveedor(){
        $("#pagarproveedor_dlg").dialog("open");
    }

         function escogerAnticipoProveedor(){
        $("#anticipoproveedor_dlg").dialog("open");
    }

    onSelectCaja = function(fk,nombre,objfk,name){
            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#caja_dlg").dialog("close");
    }

    onSelectVentasDoce = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#ventasdoce_dlg").dialog("close");
    }


 onSelectVentasCero = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#ventascero_dlg").dialog("close");
    }

     onSelectIvaVentas= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#ivaventas_dlg").dialog("close");
    }

    onSelectDescuentoVentas= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#descuentoventas_dlg").dialog("close");
    }
    onSelectRetFuenteVentas= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#retfuentesventas_dlg").dialog("close");
    }

    onSelectRetIvaVentas= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#retivaventas_dlg").dialog("close");
    }

 onSelectCobrarCliente= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#cobrarcliente_dlg").dialog("close");
    }

 onSelectReembolsoCliente= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#reembolsocliente_dlg").dialog("close");
    }

    onSelectComprasDoce= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#comprasdoce_dlg").dialog("close");
    }

    onSelectComprasCero= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#comprascero_dlg").dialog("close");
    }

    onSelectDescuentoCompra= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#descuentocompra_dlg").dialog("close");
    }
    onSelectIvaCompra=function(fk,nombre,objfk,name){
            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#ivacompra_dlg").dialog("close");
    }
    onSelectPagarProveedor=function(fk,nombre,objfk,name){
            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#pagarproveedor_dlg").dialog("close");
    }
     onSelectAnticipoProveedor=function(fk,nombre,objfk,name){
            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#anticipoproveedor_dlg").dialog("close");
    }
</script>



