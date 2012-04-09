<span style="float:left;">Dato producto</span>
<input type="text" id="txt_producto" name="nombre" size="40" >
<button onclick="buscarProducto()">Buscar</button>
<hr>

<div id="producto_tabla"></div>

<script type="text/javascript">
function buscarProducto() {
	var datos = {
		'nombre':$('#txt_producto').val(),
		'casa_id' : '<?php echo $casa_id;?>'
	}
	var urllista = '<?php echo CHtml::normalizeUrl(array('catalogos/productoAjax'))?>';
	$('#producto_tabla').load(urllista, datos);
}
$('#txt_producto').keydown(function(event) {
	if (event.keyCode == '13') {
		event.preventDefault();
		buscarProducto();
	}
});
</script>