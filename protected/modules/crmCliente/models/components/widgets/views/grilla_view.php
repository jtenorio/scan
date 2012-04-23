<?php
$cs=Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->baseUrl . '/css/ui-lightness/jquery-ui-1.8.16.custom.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/css/ui.jqgrid.css');

$cs->registerCssFile(Yii::app()->baseUrl . '/css/demo_page.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/css/demo_table.css');

$cs->registerCssFile(Yii::app()->baseUrl . '/css/jquery.autocomplete.css');

//$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-1.5.2.min.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/i18n/grid.locale-es.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.jqGrid.src.js', CClientScript::POS_HEAD);

$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.autocomplete.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.bgiframe.min.js', CClientScript::POS_HEAD);
//$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-ui.min.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.dataTables.js', CClientScript::POS_HEAD);
?>

<script>   
function cargarGrilla(){
  $("#list").jqGrid({      
//    url:'example.php',
    datatype: 'xml',
    mtype: 'GET',
    colNames:['<strong>Código</strong>','Producto', 'Cantidad','Valor','Total','C.Costo','','',''],
    colModel :[      
      {name:'codigo', index:'codigo', width:150,editable:true,edittype:"text",editoptions:{size:10,readonly:true},editrules:{required:true}},
      {name:'producto', index:'producto', width:410,editable:true,editoptions:{size:10,readonly:true},editrules:{required:true}},
      {name:'cantidad', index:'cantidad', width:70, align:'right',editable:true,editoptions:{size:10},editrules:{required:true}},
      {name:'valor', index:'valor', width:70, align:'right',editable:true,editoptions:{size:10,readonly:true},editrules:{required:true}},
      {name:'total', index:'total', width:70, align:'right',editable:true,editoptions:{size:10,readonly:true},editrules:{required:true}},
      {name:'ccosto', index:'ccosto', width:80, align:'right',editable:true,editoptions:{size:10,readonly:true},editrules:{required:true}},
      {name:'idProducto', index:'idProducto', width:1,editable:true,editoptions:{readonly:true,style:'color:#FFF'},editrules:{required:true}},
      {name:'idCcosto', index:'idCcosto', width:1,editable:true,editoptions:{readonly:true},editrules:{required:true}},
      {name:'tarifaIva', index:'tarifaIva', width:1,editable:true,editoptions:{readonly:true},editrules:{required:true}},
    ],
    rowNum:10,
    rowList:[10,20,30],
    sortname: 'invid',
    sortorder: 'desc',
    viewrecords: false,
    gridview: false,
    caption: 'Ingreso de productos',
    editurl:"formulario.php"
  });
}

function agregar(codigos,productos,cantidads,valors,ccostos,idProductos,idCcostos,tarifaIvas){    
    if(cantidads>0){
        if((valors>0)){
            cantidads = redondear(cantidads,2);
            valors = redondear(valors,2);
            var base;            
            var ids = jQuery('#list').jqGrid('getGridParam','records') + 1;            
            var totals = redondear(valors * cantidads , 2);
            var datarow = {codigo:codigos,producto:productos,cantidad:cantidads,valor:valors,total:totals,ccosto:ccostos,idProducto:idProductos,idCcosto:idCcostos,tarifaIva:tarifaIvas};
            var su=jQuery("#list").jqGrid('addRowData',ids,datarow);
            if(!su)
                alert("Error, producto no ingresado");
            else{
                calcularValores();
            }
        }else{
            alert("El item Valor es incorrecto");
        }
    }else{
        alert("El item Cantidad es incorrecto");
    }

}

function agregarVer(codigos,productos,cantidads,valors,ccostos,idProductos,idCcostos,tarifaIvas){
    if(cantidads>0){
        if((valors>0)){
            cantidads = redondear(cantidads,2);
            valors = redondear(valors,2);
            var base;
            var ids = jQuery('#list').jqGrid('getGridParam','records') + 1;
            var totals = redondear(valors * cantidads , 2);
            var datarow = {codigo:codigos,producto:productos,cantidad:cantidads,valor:valors,total:totals,ccosto:ccostos,idProducto:idProductos,idCcosto:idCcostos,tarifaIva:tarifaIvas};
            var su=jQuery("#list").jqGrid('addRowData',ids,datarow);
            if(!su)
                alert("Error, producto no ingresado");
        }else{
            alert("El item Valor es incorrecto");
        }
    }else{
        alert("El item Cantidad es incorrecto");
    }

}

function modificar(id,codigos,productos,cantidads,valors,ccostos,idProductos,idCcostos,tarifaIvas){
    if(cantidads>0){
        if((valors>0)){
            var total = redondear(valors * cantidads , 2);
            var su=jQuery("#list").jqGrid('setRowData',id,{codigo:codigos,producto:productos,cantidad:cantidads,valor:valors,total:total,ccosto:ccostos,idProducto:idProductos,idCcosto:idCcostos,tarifaIva:tarifaIvas});
            if(!su)
                alert("Error al modificar el registro");
            else{
                calcularValores();
            }
            $("#divEditarProductos").dialog("close");
        }else{
            alert("El item Valor es incorrecto");
        }
    }else{
        alert("El item Cantidad es incorrecto");
    }

}

function eliminar(){
    var gr = jQuery("#list").jqGrid('getGridParam','selrow');
    var su=jQuery("#list").jqGrid('setRowData',gr,{codigo:'0',producto:'0',cantidad:'0',valor:'0',total:'0',ccosto:'0',idProducto:'0',idCcosto:'0',tarifaIva:'0'});
    if(!su)
        alert("Error al modificar el registro");
    else{
        $("#"+gr).hide();
        calcularValores();
    }
}
function calcularValores(bandera){
    var i, ret;
    var base_imponible = 0, base_imponible_gravada = 0, base_imponible_no_iva = 0;
    var numItems = jQuery('#list').jqGrid('getGridParam','records');
    var montoIva, saldo;
    var hiddenProductos="";
    for(i=1;i<=numItems;i++){
        ret = jQuery("#list").jqGrid('getRowData',i);
        if(ret.codigo!=0){
            hiddenProductos=hiddenProductos+"<input type='hidden' name='codigoProducto[]' value='"+ret.codigo+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='nombreProducto[]' value='"+ret.producto+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='cantidadProducto[]' value='"+ret.cantidad+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='valorProducto[]' value='"+ret.valor+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='totalProducto[]' value='"+ret.total+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='ccostoProducto[]' value='"+ret.ccosto+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='idProducto[]' value='"+ret.idProducto+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='idCcosto[]' value='"+ret.idCcosto+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='tarifaIvaProducto[]' value='"+ret.tarifaIva+"' />";
        }
        if(ret.tarifaIva==1){
            base_imponible = base_imponible + parseFloat(ret.total);
        }
        if(ret.tarifaIva==2){
            base_imponible_gravada = base_imponible_gravada + parseFloat(ret.total);
        }
        if(ret.tarifaIva==3){
            base_imponible_no_iva = base_imponible_no_iva + parseFloat(ret.total);
        }
    }
    $("#productos").html(hiddenProductos);
    if(base_imponible_gravada>0){
        montoIva = base_imponible_gravada * 0.12;
        $("#monto_iva").val(redondear(montoIva,2));
        $("#Compra_montoiva").val(redondear(montoIva,2));
        if(!bandera){
            $("#iva_bienes_monto_iva").val(redondear(montoIva,2));
            $("#iva_bienes_valor_retencion").val(redondear(montoIva * 0.30,2));

            $("#Compra_montobaseiva30").val(redondear(montoIva,2));
            $("#Compra_retencioniva30").val(redondear(montoIva * 0.30,2));
        }
    }else{
        montoIva=0;
        $("#monto_iva").val(redondear(montoIva,2));
        $("#Compra_montoiva").val(redondear(montoIva,2));
        if(!bandera){
            $("#iva_bienes_monto_iva").val(redondear(montoIva,2));
            $("#iva_bienes_valor_retencion").val(redondear(montoIva * 0.30,2));

            $("#Compra_montobaseiva30").val(redondear(montoIva,2));
            $("#Compra_retencioniva30").val(redondear(montoIva * 0.30,2));
        }
    }
    if(!bandera){
        $("#base0_1").val(redondear(base_imponible,2));
        $("#base12_1").val(redondear(base_imponible_gravada,2));
        $("#base_no_objeto_1").val(redondear(base_imponible_no_iva,2));
        $("#base_imponible_1").val(redondear(base_imponible + base_imponible_gravada + base_imponible_no_iva,2));
        $("#porcentaje_retencion_1").val(0);
        $("#valor_retenido_1").val(0);
        $("#cod_ret_fuente_1 option[value='']").attr("selected",true);

        $("#base0_2").val(0);
        $("#base12_2").val(0);
        $("#base_no_objeto_2").val(0);
        $("#base_imponible_2").val(0);
        $("#porcentaje_retencion_2").val(0);
        $("#valor_retenido_2").val(0);
        $("#cod_ret_fuente_2 option[value='']").attr("selected",true);

        $("#base0_3").val(0);
        $("#base12_3").val(0);
        $("#base_no_objeto_3").val(0);
        $("#base_imponible_3").val(0);
        $("#porcentaje_retencion_3").val(0);
        $("#valor_retenido_3").val(0);
        $("#cod_ret_fuente_3 option[value='']").attr("selected",true);

        $("#base0_4").val(0);
        $("#base12_4").val(0);
        $("#base_no_objeto_4").val(0);
        $("#base_imponible_4").val(0);
        $("#porcentaje_retencion_4").val(0);
        $("#valor_retenido_4").val(0);
        $("#cod_ret_fuente_4 option[value='']").attr("selected",true);

        $("#base0_5").val(0);
        $("#base12_5").val(0);
        $("#base_no_objeto_5").val(0);
        $("#base_imponible_5").val(0);
        $("#porcentaje_retencion_5").val(0);
        $("#valor_retenido_5").val(0);
        $("#cod_ret_fuente_5 option[value='']").attr("selected",true);

        $("#base0_6").val(0);
        $("#base12_6").val(0);
        $("#base_no_objeto_6").val(0);
        $("#base_imponible_6").val(0);
        $("#porcentaje_retencion_6").val(0);
        $("#valor_retenido_6").val(0);
        $("#cod_ret_fuente_6 option[value='']").attr("selected",true);
    }

    if($("#iva_bienes_valor_retencion").val() == undefined){
        $("#Compra_basecero").val(redondear(base_imponible,2));
        $("#Compra_basegravada").val(redondear(base_imponible_gravada,2));
        $("#Compra_basenograva").val(redondear(base_imponible_no_iva,2));
        if($("#txtDocumentoModificado").val() == undefined){
            saldo = base_imponible + base_imponible_gravada + base_imponible_no_iva + montoIva - parseFloat($("#Compra_retencioniva30").val()) - parseFloat($("#Compra_retenidoiva70").val()) - parseFloat($("#Compra_retenidoiva100").val()) - parseFloat($("#valor_retenido_1").val()) - parseFloat($("#valor_retenido_2").val()) - parseFloat($("#valor_retenido_3").val()) - parseFloat($("#valor_retenido_4").val()) - parseFloat($("#valor_retenido_5").val()) - parseFloat($("#valor_retenido_6").val());
            $("#Compraingresocstm_saldocompra").val(redondear(saldo,2));
            $("#Compraingresocstm_pagosrealizados").val("1");
            generarPagos();
        }else{
            saldo = base_imponible + base_imponible_gravada + base_imponible_no_iva + montoIva;
            $("#Compraingresocstm_pagadocompra").val(redondear(saldo,2));
        }
    }else{
        saldo = base_imponible + base_imponible_gravada + base_imponible_no_iva + montoIva - parseFloat($("#iva_bienes_valor_retencion").val()) - parseFloat($("#iva_servicios_valor_retencion").val()) - parseFloat($("#iva_100_valor_retencion").val()) - parseFloat($("#valor_retenido_1").val()) - parseFloat($("#valor_retenido_2").val()) - parseFloat($("#valor_retenido_3").val()) - parseFloat($("#valor_retenido_4").val()) - parseFloat($("#valor_retenido_5").val()) - parseFloat($("#valor_retenido_6").val());
        $("#base_imponible").val(redondear(base_imponible,2));
        $("#base_imponible_gravada").val(redondear(base_imponible_gravada,2));
        $("#base_imponible_no_iva").val(redondear(base_imponible_no_iva,2));
        $("#saldo").val(redondear(saldo,2));
        $("#numeroPagos").val("1");
        generarPagos();
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

function abrirAgregar(url,tipo) {
    var urllista = url;
    var data={
            tipos:tipo
        }
    $("#divProductoBusqueda").dialog({
                closeOnEscape: true,
                height: 400 ,
                hide: 'slide',
                modal: true ,
                title: 'Búsqueda de Producto',
                width: 600
                });

    $("#divProductoBusquedaDetalle").text("buscando...");

    $("#divProductoBusquedaDetalle").load(urllista, data, function(){
            if("") {
                    (idProductos);
            }
    });
}

function abrirEdicionProducto(url){
    var ids = jQuery("#list").jqGrid('getGridParam','selrow');
    if (ids) {
        var ret = jQuery("#list").jqGrid('getRowData',ids);
        var data={
            id:ids,
            codigos:ret.codigo,
            productos : ret.producto,
            cantidads : ret.cantidad,
            valors : ret.valor,
            totals : ret.total,
            ccostos : ret.ccosto,
            idProductos : ret.idProducto,
            idCcostos : ret.idCcosto,
            tarifaIvas : ret.tarifaIva
        }
        var idInmueble = '1';
        $("#divEditarProductos").dialog({
                    closeOnEscape: true,
                    height: 400 ,
                    hide: 'slide',
                    modal: true ,
                    title: 'Edición de Producto',
                    width: 600
                    });
        var urllista = url;
        $("#detalleEditarProductos").text("buscando...");
        $("#detalleEditarProductos").load(urllista,data, function(){ if("") {
            (idInmueble);
        } });
    } else {
        alert("Seleccione una fila");
    }
}


</script>

<table id="list"><tr><td/></tr></table>
<div id="pager"></div>
<?php
if($tipo=='crear' || $tipo=='modificar'){
    echo CHtml::button("Agregar", array("onclick" => 'javascript:abrirAgregar("'.CHtml::normalizeUrl(array('Compra/buscarAjaxProducto')).'",0);'));
    echo CHtml::button("Editar", array("onclick" => 'javascript:abrirEdicionProducto("'.CHtml::normalizeUrl(array('Compra/buscarAjaxProductoEditar')).'");'));
    echo CHtml::button("Eliminar", array("onclick" => 'javascript:eliminar();'));
}
if($tipo=='devolucion'){
    echo CHtml::button("Agregar", array("onclick" => 'javascript:abrirAgregar("'.CHtml::normalizeUrl(array('Compra/buscarAjaxProducto')).'",1);'));
    echo CHtml::button("Editar", array("onclick" => 'javascript:abrirEdicionProducto("'.CHtml::normalizeUrl(array('Compra/buscarAjaxProductoEditar')).'");'));
    echo CHtml::button("Eliminar", array("onclick" => 'javascript:eliminar();'));
}
?>
<div id="divProductoBusqueda" style="display:none;">
    <div id="divProductoBusquedaDetalle"></div>
</div>

<?php
$sql = "SELECT codigoproducto, nombre, cantidad, valorunitario, i.id as idprod, tarifaiva
        FROM detallecompra dc, item i, itembodega ib
        WHERE dc.iditembodega=ib.id AND ib.iditem=i.id AND idcompra=".$text;
$connection = Yii::app()->getDb();
$dataReader=$connection->createCommand($sql)->query();
echo '<script languaje="javascript">';
echo '$(document).ready(function(){
    cargarGrilla();
    ';
$hidden = '';
foreach($dataReader as $row){
   echo 'agregarVer("'.$row['codigoproducto'].'","'.$row['nombre'].'","'.$row['cantidad'].'","'.$row['valorunitario'].'","","'.$row['idprod'].'",0,"'.$row['tarifaiva'].'"); ';
   $hidden .= '<input type="hidden" name="codigoProducto[]" value="'.$row['codigoproducto'].'" /> ';
   $hidden .= '<input type="hidden" name="nombreProducto[]" value="'.$row['nombre'].'" /> ';
   $hidden .= '<input type="hidden" name="cantidadProducto[]" value="'.$row['cantidad'].'" /> ';
   $hidden .= '<input type="hidden" name="valorProducto[]" value="'.$row['valorunitario'].'" /> ';
   $hidden .= '<input type="hidden" name="totalProducto[]" value="'.$row['valorunitario']*$row['cantidad'].'" /> ';
   $hidden .= '<input type="hidden" name="ccostoProducto[]" value="" /> ';
   $hidden .= '<input type="hidden" name="idProducto[]" value="'.$row['idprod'].'" /> ';
   $hidden .= '<input type="hidden" name="idCcosto[]" value="0" />';
   $hidden .= '<input type="hidden" name="tarifaIvaProducto[]" value="'.$row['tarifaiva'].'" /> ';
}
echo ' }); </script> ';
echo '<div id="productos">'.$hidden.'</div>';

?>
<div id="divInmuebles" style="display:none;">
    <div id="detalleInmuebles"></div>
</div>

<div id="divEditarProductos" style="display:none;">
    <div id="detalleEditarProductos"></div>
</div>