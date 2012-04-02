<span style="float:left;">Nombre actividad</span>
<input type="text" id="txt_actividad" name="nombre" size="40" >
<button onclick="buscarActividad()">Buscar</button>
<hr>

<div id="actividad_tabla"></div>

<script type="text/javascript">
function buscarActividad() {
	var datos = {
		'nombre':$('#txt_actividad').val()
	}
	var urllista = '<?php echo CHtml::normalizeUrl(array('catalogos/actividad'))?>';
	$('#actividad_tabla').load(urllista, datos);
}
$('#txt_actividad').keydown(function(event) {
	if (event.keyCode == '13') {
		event.preventDefault();
		buscarActividad();
	}
});
buscarActividad();
</script>