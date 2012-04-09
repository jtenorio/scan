<script>
function actionurl1(url){
    var data={
        numeroCompra:$("#txtNombre").val(),
        proveedor:$("#txtProveedor").val()
    }
    $("#resultadobusqueda").text("generando...");
    
    $("#resultadobusqueda").load(url,data, function(){  });
}
</script>
<?php
echo '<input type="text" name="txtNombre" id="txtNombre" size="30" />';
echo '<input type="hidden" name="txtProveedor" id="txtProveedor", value="'.$proveedor.'" />';
echo CHtml::button("Buscar", array("onclick" => 'javascript:actionurl1("'.CHtml::normalizeUrl(array('compra/resultadoBuscarAjaxCompra')).'");'));
?>
<hr>
<div id="resultadobusqueda"></div>