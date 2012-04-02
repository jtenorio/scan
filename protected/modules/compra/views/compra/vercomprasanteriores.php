<?php
$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/validarCompraAnterior.js', CClientScript::POS_HEAD);



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
    height:80px;
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
    generarPagos();
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

function generarPagos() {
    var html='';
    var i;
    var contador = $("#Compraingresocstm_pagosrealizados").val();
    var saldo = $("#Compraingresocstm_saldocompra").val();
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
                html = html + '<td><input type="text" name="valorPago[]" value="'+redondear(resta,2)+'" readonly="readonly" /></td>';
                html = html + '<td><input type="text" name="saldoPago[]" value="'+redondear(saldo,2)+'" readonly = "readonly" /></td>';
                html = html + '<td><input type="text" name="fechaPago[]" value="'+anio+'-'+mes+'-'+dia+'" size="10" readonly = "readonly" /></td>';
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
echo CHtml::form("vercomprasanteriores", "post",array("id"=>"formComprasAnteriores","name"=>"formComprasAnteriores"));
?>

<h1>Ver Compras Anteriores</h1>
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
echo CHtml::hiddenField("ultimoDiaMes", $compra->fechaemision, array("id" => "ultimoDiaMes","readonly"=>"readonly"));

echo CHtml::activeHiddenField($compra, 'idmesperiodo');
echo CHtml::activeHiddenField($compra, 'autorizacompra');
echo CHtml::activeHiddenField($compra, 'fechacaduca');

echo CHtml::hiddenField("ultimoDiaMes", $ultimoDiaMes, array("id" => "ultimoDiaMes","readonly"=>"readonly"));

?>
<div class="cabecera">
  <div class="contenido"><strong>Mes</strong></div>
  <div class="contenido"><?php echo Periodocontable::model()->buscaNombre($compra->idmesperiodo) ?></div>
  <div class="contenido"><strong>Año</strong></div>
  <div class="contenido"><?php //echo Ejerciciocontable::model()->buscaNombre($maestroAsiento->periodocontable) ?></div>
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
            'url'=> CController::createUrl('Compra/cargarTipoComprobante'),
            'update'=>'#Compra_idtipocomprobante',
            'data'=>array('tipo_identificacion'=>'js:this.value'),
        )));
    ?>
  </div>
  <div class="separador"></div>
  <div class="contenidoGrande"><strong>Tipo de Pago</strong></div>
  <div class="contenidoGrande"><?php echo CHtml::activeListBox($compraCstm, 'tipoproveedor', $tipoPago, array("size" => "1",'options'=>array('1'=>array('selected'=>'selected')),'disabled'=>'disabled')); ?></div>
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
        echo CHtml::activeListBox($compra, 'idtipocomprobante', Secuencialtransaccion::model()->buscaTipoComprobante($compra->idsecuencialtransaccion),array(
            'disabled'=>'disabled',
            'size' => '1',
            'style'=>'width:220px;',
            'prompt' => 'Seleccionar',
            ));
    ?>
      
  </div>

  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>Fecha Emisión</strong></div>
  <div class="contenidoPequeno"><?php echo CHtml::activeTextField($compra, 'fechaemision', array("size" => "10","readonly" => "readonly")); ?></div>
  <div class="separador"></div>
  <div class="contenidoPequeno"><strong>Fecha Registro</strong></div>
  <div class="contenidoPequeno"><?php echo CHtml::activeTextField($compra, 'fecharegistro', array("size" => "10","readonly" => "readonly")); ?></div>

  <div class="contenidoPequeno"><strong>No. Serie</strong></div>
  <div class="contenidoGrande">
  <?php
    echo CHtml::activeTextField($compra, 'estabcompra', array("size" => "3","readonly" => "readonly"));
    echo CHtml::activeTextField($compra, 'puntocompra', array("size" => "3","readonly" => "readonly"));
    echo "<strong>Secuen.</strong>";
    echo CHtml::activeTextField($compra, 'secuencialcompra', array("size" => "4","readonly" => "readonly"));
  ?>
  </div>
</div>
<div class="contenido3">
    <div class="contenidoPequeno"><strong>Concepto</strong></div>
    <div class="contenidoGrande"><?php echo CHtml::activeTextField($compraCstm, 'conceptocompra', array("size" => "120","readonly" => "readonly")); ?></div>
</div>


<div class="contenido4">
    <table border="0" width="100%">
        <tr>
            <td><strong>Base Imponible 0%</strong></td>
            <td><?php echo CHtml::activeTextField($compra, 'basecero', array("size" => "7","readonly" => "readonly")); ?></td>
            <td>Forma Pago</td>
            <td><?php echo CHtml::activeListBox($compra, 'formapago', $formaPago, array("size" => "1",'style'=>'width:180px;','disabled'=>'disabled'));?></td>
        </tr>
    </table>
    <br/>
    <table width="100%">
        <tr>
            <td>Fecha Vence</td>
            <td><?php echo CHtml::activeTextField($compraCstm, 'fechavencimiento', array("size" => "10","readonly" => "readonly")); ?></td>
            <td>Pagado</td>
            <td><?php echo CHtml::activeTextField($compraCstm, 'pagadocompra', array("size" => "20","readonly" => "readonly")); ?></td>
            <td>Saldo</td>
            <td><?php echo CHtml::activeTextField($compraCstm, 'saldocompra', array("size" => "20","readonly" => "readonly")); ?></td>
        </tr>
    </table>
</div>

<br/>

<h2>Pagos</h2>
<table>
    <tr>
        <td>Número de Pagos</td>
        <td><?php echo CHtml::activeTextField($compraCstm, 'pagosrealizados', array("size" => "5","readonly" => "readonly")); ?></td>
    </tr>
</table>
<div id="pagosGenerados">

</div>
<br/>
<!--<input id="button_save" type="submit" value="save" name="button_save">-->
<input id="button_save" type="submit" value="save" name="button_save">
<input id="button_exit" type="button" value="exit" name="button_exit">
<?php
echo CHtml::hiddenField("bandera", "guardar");
echo CHtml::hiddenField("idCompra", $idCompra, array("id" => "idCompra"));
echo CHtml::hiddenField("idMaestroAsiento", $idMaestroAsiento, array("id" => "idMaestroAsiento"));
echo CHtml::hiddenField("idCompraCstm", $idCompraCstm, array("id" => "idCompraCstm"));

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

