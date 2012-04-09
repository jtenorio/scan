<?php
$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/validarCompraDevolucion.js', CClientScript::POS_HEAD);

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<style>
    .cabecera {
    text-align:left;
    margin:auto;
    width:900px;
    height:25px;
    border-width: 1px;
    border-style: solid;
    border-color: #000;
    padding: 10px;
   }

   .contenido1 {
    text-align:left;
    margin:auto;
    width:900px;
    height:100px;
    border-width: 1px;
    border-style: solid;
    border-color: #000;
    padding: 10px;
   }

   .contenido2 {
    text-align:left;
    margin:auto;
    width:900px;
    height:130px;
    border-width: 1px;
    border-style: solid;
    border-color: #000;
    padding: 10px;
   }

   .contenido3 {
    text-align:left;
    margin:auto;
    width:900px;
    height:40px;
    border-width: 1px;
    border-style: solid;
    border-color: #000;
    padding: 10px;
   }

   .contenido4 {
    text-align:left;
    margin:auto;
    width:900px;
    height:90px;
    border-width: 1px;
    border-style: solid;
    border-color: #000;
    padding: 10px;
   }

   .contenido5 {
    text-align:left;
    margin:auto;
    width:900px;
    height:250px;
    border-width: 1px;
    border-style: solid;
    border-color: #000;
    padding: 10px;
   }

   .contenido4_1 {
    width:80px;
    height:20px;
    float:left;
    padding: 10px;
   }

   .contenidoGrande {
    width:180px;
    height:20px;
    float:left;
    padding: 10px;
   }
   .contenidoGrande1 {
    width:200px;
    height:20px;
    float:left;
   }

   .contenidoPequeno {
    width:95px;
    height:20px;
    float:left;
    padding: 10px;
   }

   .contenido {
    width:100px;
    height:20px;
    float:left;
   }

   .separador {
    width:50px;
    height:20px;
    float:left;
   }
</style>
<script>
$(document).ready(function(){
});

function escogerProveedor() {
    $("#modelo_dlg").dialog("open");
}
onSelectProveedor = function(fk,nombre,objfk,name,autorizacionFactura,fechaCaducidad){    
    $("#Compra_idproveedor").val(fk);
    $("#Compra_autorizacompra").val(autorizacionFactura);
    $("#Compra_fechacaduca").val(fechaCaducidad);
    $("#proveedor").val(nombre);
    $("#modelo_dlg").dialog("close");
}

function generarAsiento(url) {
    var urllista = url;
    var ret,i;
    var codigos = "";
    var total = "";
    var numItems = jQuery('#list').jqGrid('getGridParam','records');
    for(i=1;i<=numItems;i++){
        ret = jQuery("#list").jqGrid('getRowData',i);
        if(ret.total>0){
            codigos = codigos+"|"+ret.idProducto;
            total = total+"|"+ret.total;
        }
    }
    if($("#Compra_idporcentajeiva").val()=='')
        var porcentajeIva = 0;
    else
        var porcentajeIva = $("#Compra_idporcentajeiva").val();
    if($("#Compra_idporcentajeice").val()=='')
        var porcentajeIce = 0;
    else
        var porcentajeIce = $("#Compra_idporcentajeice").val();

    var data={
            idProductos:codigos,
            totalProductos:codigos,
            montoIva:$("#Compra_montoiva").val(),
            porcentajeIva:porcentajeIva,
            montoIce:$("#Compra_montoice").val(),
            porcentajeIce:porcentajeIce,
            idProveedor:$("#Compra_idproveedor").val(),
            saldo:$("#Compraingresocstm_pagadocompra").val(),
            total:total
        }
    $("#divAsiento").dialog({
                closeOnEscape: true,
                height: 400 ,
                hide: 'slide',
                modal: true ,
                title: 'Búsqueda de Producto',
                width: 600
                });

    $("#divAsientoDetalle").text("buscando...");

    $("#divAsientoDetalle").load(urllista, data, function(){
            if("") {
                    (idProductos);
            }
    });
}

function redondear(sVal, nDec){
    var n = parseFloat(sVal);
    var s = "0.00";
    if (!isNaN(n)){
        n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec);
        s = String(n);
        s += (s.indexOf(".") == -1? ".": "") + String(Math.pow(10, nDec)).substr(1);
        s = s.substr(0, s.indexOf(".") + nDec + 1);
    }
    return s;
}

function buscarCompra(url) {
    var urllista = url;
    var data={
            proveedor:$("#Compra_idproveedor").val()
        }
    $("#divProductoBusqueda").dialog({
                closeOnEscape: true,
                height: 400 ,
                hide: 'slide',
                modal: true ,
                title: 'Búsqueda de Compras',
                width: 800
                });

    $("#divProductoBusquedaDetalle").text("buscando...");

    $("#divProductoBusquedaDetalle").load(urllista, data, function(){
            if("") {
                    (idProductos);
            }
    });
}

function agregarCompra(fechaemision,estabcompra,puntocompra,secuencialcompra,autorizacompra,saldocompra,idcompras,url,basecero,basegravada,basenograva,baseice,montoiva,montoice,idtipocomprobante){
    var data={
        idcompra:idcompras
    }
    var urllista = url;

    $("#resultadobusquedacompra").text("generando...");
    $("#resultadobusquedacompra").load(urllista,data, function(){ if("") {
            (nombre_ciudad);
        } });

    $("#idCompra").val(idcompras);

    $("#Compra_basecero").val(basecero);
    $("#Compra_basegravada").val(basegravada);
    $("#Compra_basenograva").val(basenograva);
    $("#Compra_baseice").val(baseice);
    $("#Compra_montoiva").val(montoiva);
    $("#Compra_montoice").val(montoice);

    $("#txtFechaEmision").val(fechaemision);
    $("#txtEstab").val(estabcompra);
    $("#txtPunto").val(puntocompra);
    $("#txtSecuencial").val(secuencialcompra);
    $("#txtNumAutorizacion").val(autorizacompra);
    $("#txtSaldoDoc").val(saldocompra);
    $("#txtDocumentoModificado").val(idtipocomprobante);


    $("#divProductoBusqueda").dialog("close");
}

</script>
<?php
echo CHtml::form("updatedevolucioncompra", "post",array("id"=>"formDevolucionCompra","name"=>"formDevolucionCompra"));
?>
<h1>Modificar Devolución de Compras</h1>
<?php
if($validarPagado==1){
    echo '<p>Ya existen pagos realizados, anule o modifique el pago para poder modificar el registro</p>';
    $validacion = 1;
}
if($validarAsientoMayorizado==1){
    echo '<p>No puede modificar esta compra ya que el asiento contable relacionado está mayorizado</p>';
    $validacion = 1;
}
if($validarNotaCredito==1){
    echo '<p>Existe una nota de crédito relacionada</p>';
    $validacion = 1;
}
?>
<div id="validacion">

</div>
<?php
if(isset($errores)){
    foreach($errores as $key=>$valores){
        foreach($valores as $key1=>$valores1){
            echo $valores1[0].'<br/>';
        }
    }
}

echo CHtml::hiddenField("anio", $_POST['anio'], array("id" => "anio","readonly"=>"readonly"));
echo CHtml::hiddenField("mes", $_POST['mes'], array("id" => "mes","readonly"=>"readonly"));
echo CHtml::hiddenField("idCompra", $compra->idcompra, array("id" => "idCompra","readonly"=>"readonly"));
echo CHtml::hiddenField("idMaestroAsiento", $maestroAsiento->idasiento, array("id" => "idMaestroAsiento","readonly"=>"readonly"));
echo CHtml::hiddenField("idCompraCstm", $compraCstm->id, array("id" => "idCompraCstm","readonly"=>"readonly"));

echo CHtml::activeHiddenField($compra, 'idmesperiodo');
//echo CHtml::activeHiddenField($compra, 'autorizacompra');
//echo CHtml::activeHiddenField($compra, 'fechacaduca');

echo CHtml::hiddenField("ultimoDiaMes", $ultimoDiaMes, array("id" => "ultimoDiaMes","readonly"=>"readonly"));

?>
<div class="cabecera">
  <div class="contenido"><strong>Mes</strong></div>
  <div class="contenido"><?php echo Periodocontable::model()->buscaNombre($compra->idmesperiodo) ?></div>
  <div class="contenido"><strong>Año</strong></div>
  <div class="contenido"><?php echo Ejerciciocontable::model()->buscaNombre($maestroAsiento->periodocontable) ?></div>
  <div class="contenido"><strong>Bodega</strong></div>
  <div class="contenidoGrande1">
      <?php echo CHtml::activeListBox($compra, 'idbodega', $bodega, array("size" => "1",'style'=>'width:180px;','disabled'=>'disabled')); ?>
      <?php echo CHtml::hiddenField("establecimiento", $_POST['establecimiento'], array("id" => "establecimiento","readonly"=>"readonly")); ?>
  </div>
</div>

<div class="contenido1">
  <div class="contenidoGrande"><strong>Tipo Identificación</strong></div>
  <div class="contenidoGrande">
    <?php
        echo CHtml::activeListBox($compra, 'idsecuencialtransaccion', $tipoIdentificacion,array(
            'disabled'=>'disabled',
            'size' => '1',
            'prompt' => 'Seleccionar',
            'ajax' => array(
            'type'=>'POST',
            'url'=> CController::createUrl('Compra/cargartipocomprobantedevolucioncompra'),
            'update'=>'#Compra_idtipocomprobante',
            'data'=>array('tipo_identificacion'=>'js:this.value'),
        )));
    ?>
  </div>
  <div class="separador"></div>
  <div class="contenidoGrande"><strong>Tipo de Pago</strong></div>
  <div class="contenidoGrande"><?php echo CHtml::activeListBox($compraCstm, 'tipoproveedor', $tipoPago, array("size" => "1")); ?></div>
  <div class="contenidoGrande"><strong>Id. del Proveedor</strong></div>
  <div class="contenidoGrande">
  <?php
    echo CHtml::textField("proveedor", Proveedor::model()->buscaRucNombre($compra->idproveedor), array("id" => "proveedor","size" => "50","readonly"=>"readonly"));
    echo CHtml::activeHiddenField($compra, 'idproveedor');
  ?>
  </div>
</div>
<div class="contenido2">
  <div class="contenidoPequeno"><strong>Tipo Comprobante</strong></div>
  <div class="contenidoGrande">
      <?php
        echo CHtml::activeListBox($compra, 'idtipocomprobante', Secuencialtransaccion::model()->buscaTipoComprobanteDevolucion($compra->idsecuencialtransaccion),array(
            'size' => '1',
            'style'=>'width:220px;',
            'prompt' => 'Seleccionar',
            'ajax' => array(
            'type'=>'POST',
            'url'=> CController::createUrl('Compra/cargarIdentiCredito'),
            'update'=>'#Compra_idsustentotributario',
            'data'=>array('tipo_comprobante'=>'js:this.value'),
        )));
    ?>

  </div>

  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>Fecha Emisión</strong></div>
  <div class="contenidoPequeno"><?php echo CHtml::activeTextField($compra, 'fechaemision', array("size" => "10","class" => "fecha")); ?></div>
  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>Fecha Registro</strong></div>
  <div class="contenidoPequeno">
    <?php
        echo CHtml::activeTextField($compra, 'fecharegistro', array("size" => "10","class" => "fecha"));
    ?>
  </div>

  <div class="contenidoPequeno"><strong>No. Serie</strong></div>
  <div class="contenidoGrande">
  <?php
    echo CHtml::activeTextField($compra, 'estabcompra', array("size" => "3"));
    echo CHtml::activeTextField($compra, 'puntocompra', array("size" => "3"));
    echo "<strong>Secuen.</strong>";
    echo CHtml::activeTextField($compra, 'secuencialcompra', array("size" => "4"));
  ?>
  </div>
  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>No. Autorización</strong></div>
  <div class="contenidoPequeno"><?php echo CHtml::activeTextField($compra, 'autorizacompra'); ?></div>
  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>Caducidad Factura</strong></div>
  <div class="contenidoPequeno"><?php echo CHtml::activeTextField($compra, 'fechacaduca', array("size" => "10","class" => "fecha")); ?></div>

  <div class="contenidoPequeno"><strong>Identi. Crédito</strong></div>
  <div class="contenidoGrande">
    <?php
    echo CHtml::activeListBox($compra, 'idsustentotributario', Tipocomprobante::model()->buscaIdentiCredito($compra->idtipocomprobante), array("size" => "1",'style'=>'width:220px;'));
    ?>
  </div>
  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>Ubicación en Form. 104</strong></div>
  <div class="contenidoPequeno">
    <?php echo CHtml::activeListBox($compra, 'ubicacionformulario', $ubicacionForm104, array("size" => "1",'prompt'=>'Seleccionar'));?>
  </div>

</div>

<div class="contenido5">
    <?php
        $this->widget('GrillaWidget',array('text'=>$compra->idcompra,'tipo'=>'modificar'));
    ?>
    <div id="resultadobusquedacompra"></div>
</div>

<div class="contenido3">
    <div class="contenidoPequeno"><strong>Concepto</strong></div>
    <div class="contenidoGrande"><?php echo CHtml::activeTextField($compraCstm, 'conceptocompra', array("size" => "120")); ?></div>
</div>

<?php
foreach($porcentajeIva as $key=>$values)
    foreach($values as $key1=>$valor)
        $iva[$key1] = $valor . ' / ' . $key;

foreach($porcentajeIce as $key=>$values)
    foreach($values as $key1=>$valor){
        $ice[$key1] = $valor . ' / ' . $key;
    }
?>
<div class="contenido4">
    <table border="0" width="100%">
        <tr>
            <td><strong>Base Imponible 0%</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'basecero', array("size" => "7","readonly" => "readonly")); ?></td>
            <td><strong>Base Imponible Gravada</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'basegravada', array("size" => "7","readonly" => "readonly")); ?></td>
            <td><strong>%IVA</strong></td>
            <td><?php echo CHtml::activeListBox($compra, 'idporcentajeiva', $iva, array("size" => "1"));?></td>
            <td><strong>Monto IVA</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'montoiva', array("size" => "7","readonly" => "readonly")); ?></td>
        </tr>
        <tr>
            <td><strong>Base Imponible no Objeto de IVA</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'basenograva', array("size" => "7","readonly" => "readonly")); ?></td>
            <td><strong>Base Imponible de ICE</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'baseice', array("size" => "7","readonly" => "readonly")); ?></td>
            <td><strong>%ICE</strong></td>
            <td><?php echo CHtml::activeListBox($compra, 'idporcentajeice', $ice, array("size" => "1",'prompt'=>'Seleccionar'));?></td>
            <td><strong>Monto ICE</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'montoice', array("size" => "7","readonly" => "readonly")); ?></td>
        </tr>
    </table>

</div>
<br/>
<h2>Complemento de NC/ND</h2>
<table width="100%">
    <tr>
        <td>Documento Modificado</td>
        <td><?php echo CHtml::textField('txtDocumentoModificado', Compra::model()->buscaDocumentoModificadoDevolucion($compra->idcompra),array('id'=>'txtDocumentoModificado','readonly'=>'readonly')); ?></td>
        <td>Fecha Emisión</td>
        <td><?php echo CHtml::textField('txtFechaEmision', Compra::model()->buscaFechaEmisionDevolucion($compra->idcompra),array('id'=>'txtFechaEmision','readonly'=>'readonly')); ?></td>
        <td>Saldo Doc</td>
        <td><?php echo CHtml::textField('txtSaldoDoc', Compra::model()->buscaSaldoDevolucion($compra->idcompra),array('id'=>'txtSaldoDoc','readonly'=>'readonly')); ?></td>
    </tr>
</table>
<br/>
<table width="100%">
    <tr>
        <td>No. Serie y Secuencial</td>
        <td>
        <?php
            echo CHtml::textField('txtEstab', Compra::model()->buscaEstablecimientoDevolucion($compra->idcompra),array('id'=>'txtEstab','readonly'=>'readonly',"size" => "3"));
            echo CHtml::textField('txtPunto', Compra::model()->buscaPuntoCompraDevolucion($compra->idcompra),array('id'=>'txtPunto','readonly'=>'readonly',"size" => "3"));
            echo "<strong>Secuen.</strong>";
            echo CHtml::textField('txtSecuencial', Compra::model()->buscaSecuencialDevolucion($compra->idcompra),array('id'=>'txtSecuencial','readonly'=>'readonly',"size" => "7"));
        ?>
        </td>
        <td>No. Autorización</td>
        <td><?php echo CHtml::textField('txtNumAutorizacion', Compra::model()->buscaAutorizacionDevolucion($compra->idcompra),array('id'=>'txtNumAutorizacion','readonly'=>'readonly')); ?></td>
    </tr>
</table>
<br/>
<hr/>
<br/>
<table width="100%">
    <tr>
        <td>Forma Pago</td>
        <td><?php echo CHtml::activeListBox($compra, 'formapago', $formaPago, array("size" => "1",'style'=>'width:180px;'));?></td>
        <td>Tarjeta</td>
        <td><?php echo CHtml::activeListBox($compra, 'idtarjetacredito', $tarjetaCredito, array("size" => "1",'style'=>'width:180px;',"disabled" => "disabled"));?></td>
    </tr>
</table>
<br/>
<table width="100%">
    <tr>
        <td>Fecha Vence</td>
        <td><?php echo CHtml::activeTextField($compraCstm, 'fechavencimiento', array("size" => "10","class" => "fecha")); ?></td>
        <td>Pagado</td>
        <td><?php echo CHtml::activeTextField($compraCstm, 'pagadocompra', array("size" => "20","readonly" => "readonly")); ?></td>
        <td>Saldo</td>
        <td><?php echo CHtml::activeTextField($compraCstm, 'saldocompra', array("size" => "20","readonly" => "readonly")); ?></td>
    </tr>
</table>
<h2>Asiento</h2>
<table>
    <tr>
        <td>
            <?php echo CHtml::link('Mostrar Asiento Contable','javascript:generarAsiento("'.CHtml::normalizeUrl(array('Compra/buscarAjaxAsientoDevolucion')).'");');?>
            <div id="divAsiento" style="display:none;">
                <div id="divAsientoDetalle"></div>
            </div>
        </td>
    </tr>
</table>
<br/>

<?php

    echo '<input id="button_save" type="button" value="save" name="button_save" onclick="validar();">';

?>
<?php
echo CHtml::hiddenField("bandera", "guardar");
$this->widget("SelectorDatepickerWidget", FormatUtil::defaultDateOptions("ultimo_dia"));

$this->widget('ModelosWidget', array(
                'id' => 'modelo_dlg',
                'nombre' => '',
                'selectCallback' => 'onSelectProveedor',
                'title'=>'Seleccione Proveedor',
                'url_lista'=>'Compra/buscarAjaxProveedor',
                'modelo'=>'Proveedor',
                'obj_name'=>'razonsocial',
                'obj_fk'=>'id',
                'busqueda'=>'busquedaProveedor',
                'busqueda'=>'busquedaProveedor',
          ));

echo CHtml::endForm();
?>

