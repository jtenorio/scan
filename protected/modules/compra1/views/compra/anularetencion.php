<?php
$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/anularRetencion.js', CClientScript::POS_HEAD);

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
    $("#base0_1").attr("readonly","readonly");
    $("#base12_1").attr("readonly","readonly");
    $("#base_no_objeto_1").attr("readonly","readonly");

    $("#base0_2").attr("readonly","readonly");
    $("#base12_2").attr("readonly","readonly");
    $("#base_no_objeto_2").attr("readonly","readonly");

    $("#base0_3").attr("readonly","readonly");
    $("#base12_3").attr("readonly","readonly");
    $("#base_no_objeto_3").attr("readonly","readonly");

    $("#base0_4").attr("readonly","readonly");
    $("#base12_4").attr("readonly","readonly");
    $("#base_no_objeto_4").attr("readonly","readonly");

    $("#base0_5").attr("readonly","readonly");
    $("#base12_5").attr("readonly","readonly");
    $("#base_no_objeto_5").attr("readonly","readonly");

    $("#base0_6").attr("readonly","readonly");
    $("#base12_6").attr("readonly","readonly");
    $("#base_no_objeto_6").attr("readonly","readonly");
});
function calcularValorRentencionIva(){
    $("#Compra_retencioniva30").val(redondear($("#Compra_montobaseiva30").val() * 0.30,2));

    $("#Compra_retenidoiva70").val(redondear($("#Compra_montobaseiva70").val() * 0.70,2));
    $("#Compra_retenidoiva100").val(redondear($("#Compra_montobaseiva100").val(),2));

    calcularValores(true);
}
function calcularValorRetenido(){
    var baseImponible1 = parseFloat($("#base0_1").val()) + parseFloat($("#base12_1").val()) + parseFloat($("#base_no_objeto_1").val());
    $("#base_imponible_1").val(redondear(baseImponible1,2));
    var valorRetenido1 = (parseFloat($("#porcentaje_retencion_1").val()) * parseFloat($("#base_imponible_1").val()))/100;
    $("#valor_retenido_1").val(redondear(valorRetenido1,2));

    var baseImponible2 = parseFloat($("#base0_2").val()) + parseFloat($("#base12_2").val()) + parseFloat($("#base_no_objeto_2").val());
    $("#base_imponible_2").val(redondear(baseImponible2,2));
    var valorRetenido2 = (parseFloat($("#porcentaje_retencion_2").val()) * parseFloat($("#base_imponible_2").val()))/100;
    $("#valor_retenido_2").val(redondear(valorRetenido2,2));

    var baseImponible3 = parseFloat($("#base0_3").val()) + parseFloat($("#base12_3").val()) + parseFloat($("#base_no_objeto_3").val());
    $("#base_imponible_3").val(redondear(baseImponible3,2));
    var valorRetenido3 = (parseFloat($("#porcentaje_retencion_3").val()) * parseFloat($("#base_imponible_3").val()))/100;
    $("#valor_retenido_3").val(redondear(valorRetenido3,2));

    var baseImponible4 = parseFloat($("#base0_4").val()) + parseFloat($("#base12_4").val()) + parseFloat($("#base_no_objeto_4").val());
    $("#base_imponible_4").val(redondear(baseImponible4,2));
    var valorRetenido4 = (parseFloat($("#porcentaje_retencion_4").val()) * parseFloat($("#base_imponible_4").val()))/100;
    $("#valor_retenido_4").val(redondear(valorRetenido4,2));

    var baseImponible5 = parseFloat($("#base0_5").val()) + parseFloat($("#base12_5").val()) + parseFloat($("#base_no_objeto_5").val());
    $("#base_imponible_5").val(redondear(baseImponible5,2));
    var valorRetenido5 = (parseFloat($("#porcentaje_retencion_5").val()) * parseFloat($("#base_imponible_5").val()))/100;
    $("#valor_retenido_5").val(redondear(valorRetenido5,2));

    var baseImponible6 = parseFloat($("#base0_6").val()) + parseFloat($("#base12_6").val()) + parseFloat($("#base_no_objeto_6").val());
    $("#base_imponible_6").val(redondear(baseImponible6,2));
    var valorRetenido6 = (parseFloat($("#porcentaje_retencion_6").val()) * parseFloat($("#base_imponible_6").val()))/100;
    $("#valor_retenido_6").val(redondear(valorRetenido6,2));

    calcularValores(true);
}
function escogerProveedor() {
    $("#modelo_dlg").dialog("open");
}
onSelectProveedor = function(fk,nombre,objfk,name,autorizacionFactura){
    $("#Compra_idproveedor").val(fk);
    $("#noAutorizacionComprobante").val(autorizacionFactura);
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

    if($("#Compra_porcentajeretencioniva30").val()=='')
        var retIva30P = 0;
    else
        var retIva30P = $("#Compra_porcentajeretencioniva30").val();
    if($("#Compra_porcentajeretencioniva70").val()=='')
        var retIva70P = 0;
    else
        var retIva70P = $("#Compra_porcentajeretencioniva70").val();
    if($("#Compra_porcentajeretencioniva100").val()=='')
        var retIva100P = 0;
    else
        var retIva100P = $("#Compra_porcentajeretencioniva100").val();

    if($("#cod_ret_fuente_1").val()=='')
        var retFuente1P = 0;
    else
        var retFuente1P = $("#cod_ret_fuente_1").val();
    if($("#cod_ret_fuente_2").val()=='')
        var retFuente2P = 0;
    else
        var retFuente2P = $("#cod_ret_fuente_2").val();
    if($("#cod_ret_fuente_3").val()=='')
        var retFuente3P = 0;
    else
        var retFuente3P = $("#cod_ret_fuente_3").val();
    if($("#cod_ret_fuente_4").val()=='')
        var retFuente4P = 0;
    else
        var retFuente4P = $("#cod_ret_fuente_4").val();
    if($("#cod_ret_fuente_5").val()=='')
        var retFuente5P = 0;
    else
        var retFuente5P = $("#cod_ret_fuente_5").val();
    if($("#cod_ret_fuente_6").val()=='')
        var retFuente6P = 0;
    else
        var retFuente6P = $("#cod_ret_fuente_6").val();

    var data={
            idProductos:codigos,
            totalProductos:codigos,
            montoIva:$("#Compra_montoiva").val(),
            porcentajeIva:porcentajeIva,
            montoIce:$("#Compra_montoice").val(),
            porcentajeIce:porcentajeIce,
            idProveedor:$("#Compra_idproveedor").val(),
            saldo:$("#Compraingresocstm_saldocompra").val(),
            retIva30:$("#Compra_retencioniva30").val(),
            retIva70:$("#Compra_retenidoiva70").val(),
            retIva100:$("#Compra_retenidoiva100").val(),
            retIva30P:retIva30P,
            retIva70P:retIva70P,
            retIva100P:retIva100P,
            retFuente1: $("#valor_retenido_1").val(),
            retFuente2: $("#valor_retenido_2").val(),
            retFuente3: $("#valor_retenido_3").val(),
            retFuente4: $("#valor_retenido_4").val(),
            retFuente5: $("#valor_retenido_5").val(),
            retFuente6: $("#valor_retenido_6").val(),
            retFuente1P: retFuente1P,
            retFuente2P: retFuente2P,
            retFuente3P: retFuente3P,
            retFuente4P: retFuente4P,
            retFuente5P: retFuente5P,
            retFuente6P: retFuente6P,
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


function generarPagos() {
    var html='';
    var i;
    var contador = $("#CompraingresoCstm_pagosrealizados").val();
    var saldo = $("#CompraingresoCstm_saldocompra").val();
    var resta = saldo / contador;
    var fechaString = $("#Compra_fecharegistro").val();
    var fechaRegistro = new Date(fechaString);
    var dia = '01';
    var mes = fechaRegistro.getMonth()+1;
    var anio = fechaRegistro.getFullYear();
    if(contador > 0){
        html = html + '<table>';
        html = html + '<tr><td><strong>VALOR</strong></td><td><strong>SALDO</strong></td><td><strong>FECHA</strong></td></tr>';
        for(i=1;i<=contador;i++){
            if(mes == 12){
                mes = 01;
                anio = parseInt(anio) + 1;
            }else
                mes = parseInt(mes) + 1;

            if(String(mes).length==1)
                mes = '0'+mes;
            if(String(dia).length==1)
                dia = '0'+dia;
            
            saldo = saldo - resta;
            html = html + '<tr>';
                html = html + '<td><input type="text" name="valorPago[]" value="'+redondear(resta,2)+'" /></td>';
                html = html + '<td><input type="text" name="saldoPago[]" value="'+redondear(saldo,2)+'" /></td>';
                html = html + '<td><input type="text" name="fechaPago[]" value="'+anio+'-'+mes+'-'+dia+'" size="10" /></td>';
            html = html + '</tr>';
        }
        html = html + '</table>';
        $("#pagosGenerados").html(html);
    }
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


</script>
<?php
echo CHtml::form("anularetencion", "post",array("id"=>"formAnulaRetencion","name"=>"formAnulaRetencion"));
?>
<h1>Anular Retención Compras</h1>
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
if($validarSecuencialVacio==1){
    echo '<p>No existe retención</p>';
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

?>
<div class="cabecera">
  <div class="contenido"><strong>Mes</strong></div>
  <div class="contenido"><?php echo Periodocontable::model()->buscaNombre($compra->idmesperiodo) ?></div>
  <div class="contenido"><strong>Año</strong></div>
  <div class="contenido"><?php echo Ejerciciocontable::model()->buscaNombre($maestroAsiento->periodocontable) ?></div>
  <div class="contenido"><strong>Bodega</strong></div>
  <div class="contenidoGrande1">
      <?php echo CHtml::activeListBox($compra, 'idbodega', $bodega, array("size" => "1",'style'=>'width:180px;','disabled'=>'disabled')); ?>
  </div>
  <div class="contenido"><strong>Número de Compra</strong></div>
  <div class="contenido"><?php echo Compra::model()->buscaNumeroCompra($idCompra) ?></div>

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
            'url'=> CController::createUrl('Compra/cargarTipoComprobante'),
            'update'=>'#Compra_idtipocomprobante',
            'data'=>array('tipo_identificacion'=>'js:this.value'),
        )));
    ?>
  </div>
  <div class="separador"></div>
  <div class="contenidoGrande"><strong>Tipo de Pago</strong></div>
  <div class="contenidoGrande"><?php echo CHtml::activeListBox($compraCstm, 'tipoproveedor', $tipoPago, array("size" => "1",'disabled'=>'disabled')); ?></div>
  <div class="contenidoGrande"><strong>Id. del Proveedor</strong></div>
  <div class="contenidoGrande">
  <?php
    echo CHtml::textField("proveedor", Proveedor::model()->buscaRucNombre($compra->idproveedor), array("id" => "proveedor","size" => "50", 'readonly'=>'readonly'));
    echo CHtml::activeHiddenField($compra, 'idproveedor');
  ?>
  </div>
</div>
<div class="contenido2">
  <div class="contenidoPequeno"><strong>Tipo Comprobante</strong></div>
  <div class="contenidoGrande">
      <?php
        echo CHtml::activeListBox($compra, 'idtipocomprobante', Secuencialtransaccion::model()->buscaTipoComprobante($compra->idsecuencialtransaccion),array(
            'disabled'=>'disabled',
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
  <div class="contenidoPequeno"><?php echo CHtml::activeTextField($compra, 'fechaemision', array("size" => "10",'readonly'=>'readonly')); ?></div>
  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>Fecha Registro</strong></div>
  <div class="contenidoPequeno">
    <?php
        echo CHtml::activeTextField($compra, 'fecharegistro', array("size" => "10",'readonly'=>'readonly'));
    ?>
  </div>

  <div class="contenidoPequeno"><strong>No. Serie</strong></div>
  <div class="contenidoGrande">
  <?php
    echo CHtml::activeTextField($compra, 'estabcompra', array("size" => "3",'readonly'=>'readonly'));
    echo CHtml::activeTextField($compra, 'puntocompra', array("size" => "3",'readonly'=>'readonly'));
    echo "<strong>Secuen.</strong>";
    echo CHtml::activeTextField($compra, 'secuencialcompra', array("size" => "4",'readonly'=>'readonly'));
  ?>
  </div>
  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>No. Autorización</strong></div>
  <div class="contenidoPequeno"><?php echo CHtml::activeTextField($compra, 'autorizacompra',array('readonly'=>'readonly')); ?></div>
  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>Fecha Vencimiento</strong></div>
  <div class="contenidoPequeno"><?php echo CHtml::activeTextField($compra, 'fechacaduca', array("size" => "10",'readonly'=>'readonly')); ?></div>

  <div class="contenidoPequeno"><strong>Identi. Crédito</strong></div>
  <div class="contenidoGrande">
    <?php
    echo CHtml::activeListBox($compra, 'idsustentotributario', Tipocomprobante::model()->buscaIdentiCredito($compra->idtipocomprobante), array("size" => "1",'prompt'=>'Seleccionar','style'=>'width:220px;','disabled'=>'disabled'));
    ?>
  </div>
  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>Ubicación en Form. 104</strong></div>
  <div class="contenidoPequeno">
    <?php echo CHtml::activeListBox($compra, 'ubicacionformulario', $ubicacionForm104, array("size" => "1",'disabled'=>'disabled'));?>
  </div>

</div>

<div class="contenido5">
    <?php
        $this->widget('GrillaWidget',array('text'=>$idCompra,'tipo'=>'ver'));
    ?>
</div>

<div class="contenido3">
    <div class="contenidoPequeno"><strong>Concepto</strong></div>
    <div class="contenidoGrande"><?php echo CHtml::activeTextField($maestroAsiento, 'detalle', array("size" => "120",'readonly'=>'readonly')); ?></div>
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
            <td><?php echo CHtml::activeListBox($compra, 'idporcentajeiva', $iva, array("size" => "1",'disabled'=>'disabled'));?></td>
            <td><strong>Monto IVA</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'montoiva', array("size" => "7","readonly" => "readonly")); ?></td>
        </tr>
        <tr>
            <td><strong>Base Imponible no Objeto de IVA</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'basenograva', array("size" => "7","readonly" => "readonly")); ?></td>
            <td><strong>Base Imponible de ICE</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'baseice', array("size" => "7","readonly" => "readonly")); ?></td>
            <td><strong>%ICE</strong></td>
            <td><?php echo CHtml::activeListBox($compra, 'idporcentajeice', $ice, array("size" => "1",'prompt'=>'Seleccionar','disabled'=>'disabled'));?></td>
            <td><strong>Monto ICE</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'montoice', array("size" => "7","readonly" => "readonly")); ?></td>
        </tr>
    </table>

</div>
<?php
foreach($porcentajeIvaRetencion as $key=>$values)
    foreach($values as $key1=>$valor){
        if($valor == 30)
            $porcentajeIvas30[$key1] = $valor . ' / ' . $key;
        if($valor == 70)
            $porcentajeIvas70[$key1] = $valor . ' / ' . $key;
        if($valor == 100)
            $porcentajeIvas100[$key1] = $valor . ' / ' . $key;
    }

foreach($codigosRetencionFuente as $key=>$values)
    foreach($values as $key1=>$valor)
        $codigosRetencionFuentes[$key1] = $valor . ' / ' . $key;
?>
<h2>Retenciones</h2>
<table width="100%" align="center">
    <tr>
        <td></td>
        <td>Monto IVA</td>
        <td>% Retención</td>
        <td>Valor Retención</td>
        <td>Cod. Ret. Fuente</td>
        <td>Base 0%</td>
        <td>Base 12%</td>
        <td>Base No Objeto</td>
        <td>% Ret.</td>
        <td>Valor Retenido</td>
        <td>Base Imponible</td>
    </tr>
    <tr>
        <td>Iva Bienes</td>
        <td><?php echo CHtml::activeTextField($compra, 'montobaseiva30', array("size" => "6","onchange"=>"calcularValorRentencionIva()",'readonly'=>'readonly')); ?></td>
        <td><?php echo CHtml::activeListBox($compra, 'porcentajeretencioniva30', $porcentajeIvas30, array("size" => "1",'prompt'=>'Seleccionar','style'=>'width:85px;','disabled'=>'disabled'));?></td>
        <td><?php echo CHtml::activeTextField($compra, 'retencioniva30', array("size" => "6","readonly" => "readonly")); ?></td>
        <td>
            <?php
                $codRet = 0;
                $base0_1 = 0;
                $base12_1 = 0;
                $base_no_objeto_1 = 0;
                $porcentaje_retencion_1 = 0;
                $valor_retenido_1 = 0;
                $base_imponible_1 = 0;
                $retencion = Retencionescompra::model()->buscaRetencion($idCompra);
                $i = 1;
                if($retencion!='')
                foreach($retencion as $retencions){
                    if($i==1){
                        $codRet = $retencions['idcodigoretencionfuente'];
                        $base0_1 = $retencions['basecero'];
                        $base12_1 = $retencions['basegravada'];
                        $base_no_objeto_1 = $retencions['basenogravada'];
                        $porcentaje_retencion_1 = $retencions['porcentajeretencion'];
                        $valor_retenido_1 = $retencions['valorretenido'];
                        $base_imponible_1 = $retencions['baseimponible'];
                    }
                    $i++;
                }
                echo CHtml::listBox("cod_ret_fuente_1", "", $codigosRetencionFuentes,array(
                    'disabled'=>'disabled',
                    'options'=>array($codRet=>array('selected'=>'selected')),
                    'style'=>'width:180px;',
                    'size' => '1',
                    'prompt' => 'Seleccionar',
                    'ajax' => array(
                        'type'=>'POST',
                        'url'=> CController::createUrl('Compra/cargarImpuestoRenta'),
                        'data'=>array('cod_ret_fuente_1'=>'js:this.value'),
                        'success'=>'function(data){
                                        if(data=="vacio"){
                                            $("#base0_1").val(0);
                                            $("#base12_1").val(0);
                                            $("#base_no_objeto_1").val(0);
                                            $("#base_imponible_1").val(0);
                                            $("#base0_1").attr("readonly","readonly");
                                            $("#base12_1").attr("readonly","readonly");
                                            $("#base_no_objeto_1").attr("readonly","readonly");
                                            data=0;
                                        }else{
                                            $("#base0_1").removeAttr("readonly","readonly");
                                            $("#base12_1").removeAttr("readonly","readonly");
                                            $("#base_no_objeto_1").removeAttr("readonly","readonly");
                                        }
                                        $("#porcentaje_retencion_1").val(data);
                                        var retenido = (data * $("#base_imponible_1").val())/100;
                                        $("#valor_retenido_1").val(redondear(retenido,2));
                                        calcularValores(true);
                                    }',
                    ),
                ));
            ?><br/>
            <?php
                $codRet = 0;
                $base0_2 = 0;
                $base12_2 = 0;
                $base_no_objeto_2 = 0;
                $porcentaje_retencion_2 = 0;
                $valor_retenido_2 = 0;
                $base_imponible_2 = 0;
                $retencion = Retencionescompra::model()->buscaRetencion($idCompra);
                $i = 1;
                if($retencion!='')
                foreach($retencion as $retencions){
                    if($i==2){
                        $codRet = $retencions['idcodigoretencionfuente'];
                        $base0_2 = $retencions['basecero'];
                        $base12_2 = $retencions['basegravada'];
                        $base_no_objeto_2 = $retencions['basenogravada'];
                        $porcentaje_retencion_2 = $retencions['porcentajeretencion'];
                        $valor_retenido_2 = $retencions['valorretenido'];
                        $base_imponible_2 = $retencions['baseimponible'];
                    }
                    $i++;
                }
                echo CHtml::listBox("cod_ret_fuente_2", "", $codigosRetencionFuentes,array(
                    'disabled'=>'disabled',
                    'options'=>array($codRet=>array('selected'=>'selected')),
                    'style'=>'width:180px;',
                    'size' => '1',
                    'prompt' => 'Seleccionar',
                    'ajax' => array(
                        'type'=>'POST',
                        'url'=> CController::createUrl('Compra/cargarImpuestoRenta'),
                        'data'=>array('cod_ret_fuente_1'=>'js:this.value'),
                        'success'=>'function(data){
                                        if(data=="vacio"){
                                            $("#base0_2").val(0);
                                            $("#base12_2").val(0);
                                            $("#base_no_objeto_2").val(0);
                                            $("#base_imponible_2").val(0);
                                            $("#base0_2").attr("readonly","readonly");
                                            $("#base12_2").attr("readonly","readonly");
                                            $("#base_no_objeto_2").attr("readonly","readonly");
                                            data=0;
                                        }else{
                                            $("#base0_2").removeAttr("readonly","readonly");
                                            $("#base12_2").removeAttr("readonly","readonly");
                                            $("#base_no_objeto_2").removeAttr("readonly","readonly");
                                        }
                                        $("#porcentaje_retencion_2").val(data);
                                        var retenido = (data * $("#base_imponible_2").val())/100;
                                        $("#valor_retenido_2").val(redondear(retenido,2));
                                        calcularValores(true);
                                    }',
                    ),
                ));
            ?>
        </td>
        <td>
            <?php echo CHtml::textField("base0_1", $base0_1, array("id" => "base0_1","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base0_2", $base0_2, array("id" => "base0_2","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("base12_1", $base12_1, array("id" => "base12_1","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base12_2", $base12_2, array("id" => "base12_2","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("base_no_objeto_1", $base_no_objeto_1, array("id" => "base_no_objeto_1","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base_no_objeto_2", $base_no_objeto_2, array("id" => "base_no_objeto_2","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("porcentaje_retencion_1", $porcentaje_retencion_1, array("id" => "porcentaje_retencion_1","size" => "6",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("porcentaje_retencion_2", $porcentaje_retencion_2, array("id" => "porcentaje_retencion_2","size" => "6",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("valor_retenido_1", $valor_retenido_1, array("id" => "valor_retenido_1","size" => "6",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("valor_retenido_2", $valor_retenido_2, array("id" => "valor_retenido_2","size" => "6",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("base_imponible_1", $base_imponible_1, array("id" => "base_imponible_1","size" => "6",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base_imponible_2", $base_imponible_2, array("id" => "base_imponible_2","size" => "6",'readonly'=>'readonly')); ?>
        </td>
    </tr>
    <tr>
        <td>Iva Servicios</td>
        <td><?php echo CHtml::activeTextField($compra, 'montobaseiva70', array("size" => "6","onchange"=>"calcularValorRentencionIva()",'readonly'=>'readonly')); ?></td>
        <td><?php echo CHtml::activeListBox($compra, 'porcentajeretencioniva70', $porcentajeIvas70, array("size" => "1",'prompt'=>'Seleccionar','style'=>'width:85px;','disabled'=>'disabled'));?></td>
        <td><?php echo CHtml::activeTextField($compra, 'retenidoiva70', array("size" => "6","readonly" => "readonly")); ?></td>
        <td>
            <?php
                $codRet = 0;
                $base0_3 = 0;
                $base12_3 = 0;
                $base_no_objeto_3 = 0;
                $porcentaje_retencion_3 = 0;
                $valor_retenido_3 = 0;
                $base_imponible_3 = 0;
                $retencion = Retencionescompra::model()->buscaRetencion($idCompra);
                $i = 1;
                if($retencion!='')
                foreach($retencion as $retencions){
                    if($i==3){
                        $codRet = $retencions['idcodigoretencionfuente'];
                        $base0_3 = $retencions['basecero'];
                        $base12_3 = $retencions['basegravada'];
                        $base_no_objeto_3 = $retencions['basenogravada'];
                        $porcentaje_retencion_3 = $retencions['porcentajeretencion'];
                        $valor_retenido_3 = $retencions['valorretenido'];
                        $base_imponible_3 = $retencions['baseimponible'];
                    }
                    $i++;
                }
                echo CHtml::listBox("cod_ret_fuente_3", "", $codigosRetencionFuentes,array(
                    'disabled'=>'disabled',
                    'options'=>array($codRet=>array('selected'=>'selected')),
                    'style'=>'width:180px;',
                    'size' => '1',
                    'prompt' => 'Seleccionar',
                    'ajax' => array(
                        'type'=>'POST',
                        'url'=> CController::createUrl('Compra/cargarImpuestoRenta'),
                        'data'=>array('cod_ret_fuente_1'=>'js:this.value'),
                        'success'=>'function(data){
                                        if(data=="vacio"){
                                            $("#base0_3").val(0);
                                            $("#base12_3").val(0);
                                            $("#base_no_objeto_3").val(0);
                                            $("#base_imponible_3").val(0);
                                            $("#base0_3").attr("readonly","readonly");
                                            $("#base12_3").attr("readonly","readonly");
                                            $("#base_no_objeto_3").attr("readonly","readonly");
                                            data=0;
                                        }else{
                                            $("#base0_3").removeAttr("readonly","readonly");
                                            $("#base12_3").removeAttr("readonly","readonly");
                                            $("#base_no_objeto_3").removeAttr("readonly","readonly");
                                        }
                                        $("#porcentaje_retencion_3").val(data);
                                        var retenido = (data * $("#base_imponible_3").val())/100;
                                        $("#valor_retenido_3").val(redondear(retenido,2));
                                        calcularValores(true);
                                    }',
                    ),
                ));
            ?><br/>
            <?php
                $codRet = 0;
                $base0_4 = 0;
                $base12_4 = 0;
                $base_no_objeto_4 = 0;
                $porcentaje_retencion_4 = 0;
                $valor_retenido_4 = 0;
                $base_imponible_4 = 0;
                $retencion = Retencionescompra::model()->buscaRetencion($idCompra);
                $i = 1;
                if($retencion!='')
                foreach($retencion as $retencions){
                    if($i==4){
                        $codRet = $retencions['idcodigoretencionfuente'];
                        $base0_4 = $retencions['basecero'];
                        $base12_4 = $retencions['basegravada'];
                        $base_no_objeto_4 = $retencions['basenogravada'];
                        $porcentaje_retencion_4 = $retencions['porcentajeretencion'];
                        $valor_retenido_4 = $retencions['valorretenido'];
                        $base_imponible_4 = $retencions['baseimponible'];
                    }
                    $i++;
                }
                echo CHtml::listBox("cod_ret_fuente_4", "", $codigosRetencionFuentes,array(
                    'disabled'=>'disabled',
                    'options'=>array($codRet=>array('selected'=>'selected')),
                    'style'=>'width:180px;',
                    'size' => '1',
                    'prompt' => 'Seleccionar',
                    'ajax' => array(
                        'type'=>'POST',
                        'url'=> CController::createUrl('Compra/cargarImpuestoRenta'),
                        'data'=>array('cod_ret_fuente_1'=>'js:this.value'),
                        'success'=>'function(data){
                                        if(data=="vacio"){
                                            $("#base0_4").val(0);
                                            $("#base12_4").val(0);
                                            $("#base_no_objeto_4").val(0);
                                            $("#base_imponible_4").val(0);
                                            $("#base0_4").attr("readonly","readonly");
                                            $("#base12_4").attr("readonly","readonly");
                                            $("#base_no_objeto_4").attr("readonly","readonly");
                                            data=0;
                                        }else{
                                            $("#base0_4").removeAttr("readonly","readonly");
                                            $("#base12_4").removeAttr("readonly","readonly");
                                            $("#base_no_objeto_4").removeAttr("readonly","readonly");
                                        }
                                        $("#porcentaje_retencion_4").val(data);
                                        var retenido = (data * $("#base_imponible_4").val())/100;
                                        $("#valor_retenido_4").val(redondear(retenido,2));
                                        calcularValores(true);
                                    }',
                    ),
                ));
            ?>
        </td>
        <td>
            <?php echo CHtml::textField("base0_3", $base0_3, array("id" => "base0_3","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base0_4", $base0_4, array("id" => "base0_4","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("base12_3", $base12_3, array("id" => "base12_3","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base12_4", $base12_4, array("id" => "base12_4","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("base_no_objeto_3", $base_no_objeto_3, array("id" => "base_no_objeto_3","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base_no_objeto_4", $base_no_objeto_4, array("id" => "base_no_objeto_4","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("porcentaje_retencion_3", $porcentaje_retencion_3, array("id" => "porcentaje_retencion_3","size" => "6",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("porcentaje_retencion_4", $porcentaje_retencion_4, array("id" => "porcentaje_retencion_4","size" => "6",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("valor_retenido_3", $valor_retenido_3, array("id" => "valor_retenido_3","size" => "6",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("valor_retenido_4", $valor_retenido_4, array("id" => "valor_retenido_4","size" => "6",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("base_imponible_3", $base_imponible_3, array("id" => "base_imponible_3","size" => "6",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base_imponible_4", $base_imponible_4, array("id" => "base_imponible_4","size" => "6",'readonly'=>'readonly')); ?>
        </td>
    </tr>
    <tr>
        <td>Iva 100%</td>
        <td><?php echo CHtml::activeTextField($compra, 'montobaseiva100', array("size" => "6","onchange"=>"calcularValorRentencionIva()",'readonly'=>'readonly')); ?></td>
        <td><?php echo CHtml::activeListBox($compra, 'porcentajeretencioniva100', $porcentajeIvas100, array("size" => "1",'prompt'=>'Seleccionar','style'=>'width:85px;','disabled'=>'disabled'));?></td>
        <td><?php echo CHtml::activeTextField($compra, 'retenidoiva100', array("size" => "6","readonly" => "readonly")); ?></td>
        <td>
            <?php
                $codRet = 0;
                $base0_5 = 0;
                $base12_5 = 0;
                $base_no_objeto_5 = 0;
                $porcentaje_retencion_5 = 0;
                $valor_retenido_5 = 0;
                $base_imponible_5 = 0;
                $retencion = Retencionescompra::model()->buscaRetencion($idCompra);
                $i = 1;
                if($retencion!='')
                foreach($retencion as $retencions){
                    if($i==5){
                        $codRet = $retencions['idcodigoretencionfuente'];
                        $base0_5 = $retencions['basecero'];
                        $base12_5 = $retencions['basegravada'];
                        $base_no_objeto_5 = $retencions['basenogravada'];
                        $porcentaje_retencion_5 = $retencions['porcentajeretencion'];
                        $valor_retenido_5 = $retencions['valorretenido'];
                        $base_imponible_5 = $retencions['baseimponible'];
                    }
                    $i++;
                }
                echo CHtml::listBox("cod_ret_fuente_5", "", $codigosRetencionFuentes,array(
                    'disabled'=>'disabled',
                    'options'=>array($codRet=>array('selected'=>'selected')),
                    'style'=>'width:180px;',
                    'size' => '1',
                    'prompt' => 'Seleccionar',
                    'ajax' => array(
                        'type'=>'POST',
                        'url'=> CController::createUrl('Compra/cargarImpuestoRenta'),
                        'data'=>array('cod_ret_fuente_1'=>'js:this.value'),
                        'success'=>'function(data){
                                        if(data=="vacio"){
                                            $("#base0_5").val(0);
                                            $("#base12_5").val(0);
                                            $("#base_no_objeto_5").val(0);
                                            $("#base_imponible_5").val(0);
                                            $("#base0_5").attr("readonly","readonly");
                                            $("#base12_5").attr("readonly","readonly");
                                            $("#base_no_objeto_5").attr("readonly","readonly");
                                            data=0;
                                        }else{
                                            $("#base0_5").removeAttr("readonly","readonly");
                                            $("#base12_5").removeAttr("readonly","readonly");
                                            $("#base_no_objeto_5").removeAttr("readonly","readonly");
                                        }
                                        $("#porcentaje_retencion_5").val(data);
                                        var retenido = (data * $("#base_imponible_5").val())/100;
                                        $("#valor_retenido_5").val(redondear(retenido,2));
                                        calcularValores(true);
                                    }',
                    ),
                ));
            ?><br/>
            <?php
                $codRet = 0;
                $base0_6 = 0;
                $base12_6 = 0;
                $base_no_objeto_6 = 0;
                $porcentaje_retencion_6 = 0;
                $valor_retenido_6 = 0;
                $base_imponible_6 = 0;
                $retencion = Retencionescompra::model()->buscaRetencion($idCompra);
                $i = 1;
                if($retencion!='')
                foreach($retencion as $retencions){
                    if($i==6){
                        $codRet = $retencions['idcodigoretencionfuente'];
                        $base0_6 = $retencions['basecero'];
                        $base12_6 = $retencions['basegravada'];
                        $base_no_objeto_6 = $retencions['basenogravada'];
                        $porcentaje_retencion_6 = $retencions['porcentajeretencion'];
                        $valor_retenido_6 = $retencions['valorretenido'];
                        $base_imponible_6 = $retencions['baseimponible'];
                    }
                    $i++;
                }
                echo CHtml::listBox("cod_ret_fuente_6", "", $codigosRetencionFuentes,array(
                    'disabled'=>'disabled',
                    'options'=>array($codRet=>array('selected'=>'selected')),
                    'style'=>'width:180px;',
                    'size' => '1',
                    'prompt' => 'Seleccionar',
                    'ajax' => array(
                        'type'=>'POST',
                        'url'=> CController::createUrl('Compra/cargarImpuestoRenta'),
                        'data'=>array('cod_ret_fuente_1'=>'js:this.value'),
                        'success'=>'function(data){
                                        if(data=="vacio"){
                                            $("#base0_6").val(0);
                                            $("#base12_6").val(0);
                                            $("#base_no_objeto_6").val(0);
                                            $("#base_imponible_6").val(0);
                                            $("#base0_6").attr("readonly","readonly");
                                            $("#base12_6").attr("readonly","readonly");
                                            $("#base_no_objeto_6").attr("readonly","readonly");
                                            data=0;
                                        }else{
                                            $("#base0_6").removeAttr("readonly","readonly");
                                            $("#base12_6").removeAttr("readonly","readonly");
                                            $("#base_no_objeto_6").removeAttr("readonly","readonly");
                                        }
                                        $("#porcentaje_retencion_6").val(data);
                                        var retenido = (data * $("#base_imponible_6").val())/100;
                                        $("#valor_retenido_6").val(redondear(retenido,2));
                                        calcularValores(true);
                                    }',
                    ),
                ));
            ?>
        </td>
        <td>
            <?php echo CHtml::textField("base0_5", $base0_5, array("id" => "base0_5","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base0_6", $base0_6, array("id" => "base0_6","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("base12_5", $base12_5, array("id" => "base12_5","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base12_6", $base12_6, array("id" => "base12_6","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("base_no_objeto_5", $base_no_objeto_5, array("id" => "base_no_objeto_5","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base_no_objeto_6", $base_no_objeto_6, array("id" => "base_no_objeto_6","size" => "6","onchange"=>"calcularValorRetenido()",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("porcentaje_retencion_5", $porcentaje_retencion_5, array("id" => "porcentaje_retencion_5","size" => "6",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("porcentaje_retencion_6", $porcentaje_retencion_6, array("id" => "porcentaje_retencion_6","size" => "6",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("valor_retenido_5", $valor_retenido_5, array("id" => "valor_retenido_5","size" => "6",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("valor_retenido_6", $valor_retenido_6, array("id" => "valor_retenido_6","size" => "6",'readonly'=>'readonly')); ?>
        </td>
        <td>
            <?php echo CHtml::textField("base_imponible_5", $base_imponible_5, array("id" => "base_imponible_5","size" => "6",'readonly'=>'readonly')); ?><br/>
            <?php echo CHtml::textField("base_imponible_6", $base_imponible_6, array("id" => "base_imponible_6","size" => "6",'readonly'=>'readonly')); ?>
        </td>
    </tr>
</table>
<h2>Comprobante Retención</h2>
<table width="100%" align="center">
    <tr>
        <td width="75px">No. Serie</td>
        <td width="120px">
            <?php echo CHtml::activeTextField($compra, 'establecimientoretencion1', array("size" => "6","readonly" => "readonly")); ?>
            <?php echo CHtml::activeTextField($compra, 'puntoemisionretencion1', array("size" => "6","readonly" => "readonly")); ?>
        </td>
        <td width="100px">No. Secuencial</td>
        <td width="75px"><?php echo CHtml::activeTextField($compra, 'secuencialretencion1', array("size" => "6","readonly" => "readonly")); ?></td>
        <td>No. Autorización</td>
        <td><?php echo CHtml::activeTextField($compra, 'autorizacionretencion1', array("size" => "6","readonly" => "readonly")); ?></td>
        <td>Fecha Emisión</td>
        <td><?php echo CHtml::activeTextField($compra, 'fecharetencion1', array("size" => "10",'readonly'=>'readonly')); ?></td>
    </tr>
</table>
<?php
echo CHtml::hiddenField("establecimiento", $compra->establecimientoretencion1, array("id" => "establecimiento"));
echo CHtml::hiddenField("puntoEmision", $compra->puntoemisionretencion1, array("id" => "puntoEmision"));
echo CHtml::hiddenField("autorizacion", $compra->autorizacionretencion1, array("id" => "autorizacion"));
echo CHtml::hiddenField("desdeHasta", $compra->secuencialretencion1, array("id" => "desdeHasta"));
?>
<br/>
<hr/>
<br/>
<table width="100%">
    <tr>
        <td>Forma Pago</td>
        <td><?php echo CHtml::activeListBox($compra, 'formapago', $formaPago, array("size" => "1",'style'=>'width:180px;','disabled'=>'disabled'));?></td>
        <td>Tarjeta</td>
        <td><?php echo CHtml::activeListBox($compra, 'idtarjetacredito', $tarjetaCredito, array("size" => "1",'style'=>'width:180px;','disabled'=>'disabled'));?></td>
    </tr>
</table>
<br/>
<table width="100%">
    <tr>
        <td>Fecha Vence</td>
        <td><?php echo CHtml::activeTextField($compraCstm, 'fechavencimiento', array("size" => "10",'readonly'=>'readonly')); ?></td>
        <td>Pagado</td>
        <td><?php echo CHtml::activeTextField($compraCstm, 'pagadocompra', array("size" => "20","readonly" => "readonly")); ?></td>
        <td>Saldo</td>
        <td><?php echo CHtml::activeTextField($compraCstm, 'saldocompra', array("size" => "20","readonly" => "readonly")); ?></td>
    </tr>
</table>
<h2>Pagos</h2>
<table>
    <tr>
        <td>Número de Pagos</td>
        <td><?php echo CHtml::activeTextField($compraCstm, 'pagosrealizados', array("size" => "5","onchange" => "generarPagos()",'readonly'=>'readonly')); ?></td>
    </tr>
</table>
<div id="pagosGenerados">
<table>
    <tr><td><strong>VALOR</strong></td><td><strong>SALDO</strong></td><td><strong>FECHA</strong></td></tr>
    <?php
        $pago = Detallepagos::model()->buscaPagos($idCompra);
        foreach($pago as $pagos){
            echo '<tr>
                    <td><input type="text" name="valorPago[]" value="'.$pagos['valor'].'" readonly="readonly" /></td>
                    <td><input type="text" name="saldoPago[]" value="'.$pagos['saldo'].'" readonly="readonly" /></td>
                    <td><input type="text" name="fechaPago[]" value="'.$pagos['fecha'].'" readonly="readonly" /></td>
                </tr>';
        }
    ?>
</table>
</div>
<h2>Asiento</h2>
<table>
    <tr>
        <td>
            <?php echo CHtml::link('Mostrar Asiento Contable','javascript:generarAsiento("'.CHtml::normalizeUrl(array('Compra/buscarAjaxAsiento')).'");');?>
            <div id="divAsiento" style="display:none;">
                <div id="divAsientoDetalle"></div>
            </div>
        </td>
    </tr>
</table>
<br/>
<?php
echo CHtml::hiddenField("idCompra", $idCompra, array("id" => "idCompra"));
echo CHtml::hiddenField("idMaestroAsiento", $idMaestroAsiento, array("id" => "idMaestroAsiento"));
echo CHtml::hiddenField("idCompraCstm", $idCompraCstm, array("id" => "idCompraCstm"));

if($validacion != 1){
    echo '<input id="button_save" type="button" value="save" name="button_save" onclick="anularRetencion();">';
}
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

