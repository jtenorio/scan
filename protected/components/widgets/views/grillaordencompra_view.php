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
    colNames:['<strong>Código</strong>','Producto', 'Cantidad','Valor','Total',''],
    colModel :[      
      {name:'codigo', index:'codigo', width:150,editable:true,edittype:"text",editoptions:{size:10,readonly:true},editrules:{required:true}},
      {name:'producto', index:'producto', width:492,editable:true,editoptions:{size:10,readonly:true},editrules:{required:true}},
      {name:'cantidad', index:'cantidad', width:70, align:'right',editable:true,editoptions:{size:10},editrules:{required:true}},
      {name:'valor', index:'valor', width:70, align:'right',editable:true,editoptions:{size:10,readonly:true},editrules:{required:true}},
      {name:'total', index:'total', width:70, align:'right',editable:true,editoptions:{size:10,readonly:true},editrules:{required:true}},      
      {name:'idProducto', index:'idProducto', width:1,editable:true,editoptions:{readonly:true,style:'color:#FFF'},editrules:{required:true}},
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

function agregar(codigos,productos,cantidads,valors,idProductos){
    if(cantidads>0){
        if((valors>0)){
            cantidads = redondear(cantidads,2);
            valors = redondear(valors,2);
            var base;            
            var ids = jQuery('#list').jqGrid('getGridParam','records') + 1;            
            var totals = redondear(valors * cantidads , 2);
            var datarow = {codigo:codigos,producto:productos,cantidad:cantidads,valor:valors,total:totals,idProducto:idProductos};
            var su=jQuery("#list").jqGrid('addRowData',ids,datarow);
            if(!su)
                alert("Error, producto no ingresado");
            else
                calcularValores();
        }else{
            alert("El item Valor es incorrecto");
        }
    }else{
        alert("El item Cantidad es incorrecto");
    }

}

function modificar(id,codigos,productos,cantidads,valors,idProductos){
    if(cantidads>0){
        if((valors>0)){
            var total = redondear(valors * cantidads , 2);
            var su=jQuery("#list").jqGrid('setRowData',id,{codigo:codigos,producto:productos,cantidad:cantidads,valor:valors,total:total,idProducto:idProductos});
            if(!su)
                alert("Error al modificar el registro");
            else
                calcularValores();
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
    var su=jQuery("#list").jqGrid('setRowData',gr,{codigo:'0',producto:'0',cantidad:'0',valor:'0',total:'0',idProducto:'0'});
    if(!su)
        alert("Error al modificar el registro");
    else{
        $("#"+gr).hide();
        calcularValores();
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
            idProductos : ret.idProducto
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

function calcularValores(){
    var i, ret;
    var numItems = jQuery('#list').jqGrid('getGridParam','records');
    var hiddenProductos="";
    for(i=1;i<=numItems;i++){
        ret = jQuery("#list").jqGrid('getRowData',i);
        if(ret.codigo!=0){
            hiddenProductos=hiddenProductos+"<input type='hidden' name='codigoProducto[]' value='"+ret.codigo+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='nombreProducto[]' value='"+ret.producto+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='cantidadProducto[]' value='"+ret.cantidad+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='valorProducto[]' value='"+ret.valor+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='totalProducto[]' value='"+ret.total+"' />";
            hiddenProductos=hiddenProductos+"<input type='hidden' name='idProducto[]' value='"+ret.idProducto+"' />";
        }
    }
    $("#productos").html(hiddenProductos);
}

</script>

<table id="list"><tr><td/></tr></table>
<div id="pager"></div>
<?php
if($tipo=='crear' || $tipo=='modificar'){
    echo CHtml::button("Agregar", array("onclick" => 'javascript:abrirAgregar("'.CHtml::normalizeUrl(array('ordencompra/buscarAjaxProducto')).'",0);'));
    echo CHtml::button("Editar", array("onclick" => 'javascript:abrirEdicionProducto("'.CHtml::normalizeUrl(array('ordencompra/buscarAjaxProductoEditar')).'");'));
    echo CHtml::button("Eliminar", array("onclick" => 'javascript:eliminar();'));
}
?>
<div id="divProductoBusqueda" style="display:none;">
    <div id="divProductoBusquedaDetalle"></div>
</div>

<?php
$sql = "SELECT codigoproducto, nombre, cantidadsolicitada, valorunitario, i.id as idprod
        FROM item i, detalleordencompra doc, ordencompra oc
        WHERE oc.id=doc.idordencompra AND doc.iditem=i.id AND oc.id=".$text;
$connection = Yii::app()->getDb();
$dataReader=$connection->createCommand($sql)->query();
echo '<script languaje="javascript">';
echo '$(document).ready(function(){
    cargarGrilla();
    ';
$hidden = '';
foreach($dataReader as $row){
   echo 'agregar("'.$row['codigoproducto'].'","'.$row['nombre'].'","'.$row['cantidadsolicitada'].'","'.$row['valorunitario'].'","'.$row['idprod'].'"); ';
   $hidden .= '<input type="hidden" name="codigoProducto[]" value="'.$row['codigoproducto'].'" /> ';
   $hidden .= '<input type="hidden" name="nombreProducto[]" value="'.$row['nombre'].'" /> ';
   $hidden .= '<input type="hidden" name="cantidadProducto[]" value="'.$row['cantidadsolicitada'].'" /> ';
   $hidden .= '<input type="hidden" name="valorProducto[]" value="'.$row['valorunitario'].'" /> ';
   $hidden .= '<input type="hidden" name="totalProducto[]" value="'.$row['valorunitario']*$row['cantidadsolicitada'].'" /> ';
   $hidden .= '<input type="hidden" name="idProducto[]" value="'.$row['idprod'].'" /> ';
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