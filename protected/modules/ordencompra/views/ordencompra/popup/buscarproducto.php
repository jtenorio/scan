<script>
function actionurl1(url){
    var data={
        nombre:$("#txtNombre").val(),
        tipoProducto:$("#txtTipoProducto").val()
    }
    var urllista = url;
    $("#resultadobusqueda").text("generando...");
    $("#resultadobusqueda").load(urllista,data, function(){ if("") {
            (nombre_ciudad);
        } });
}
</script>
<?php
echo '<input type="text" name="txtNombre" id="txtNombre" size="30" />';
echo '<input type="hidden" name="txtTipoProducto" id="txtTipoProducto" value="'.$tipoProducto.'" />';
echo CHtml::button("Buscar", array("onclick" => 'javascript:actionurl1("'.CHtml::normalizeUrl(array('ordencompra/resultadoBuscarAjaxProducto')).'");'));
?>
<hr>
<div id="resultadobusqueda"></div>