<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>$id,
	'options'=>array(
		'title'=>$title,
		'autoOpen'=>false,
		'modal'=>true,	
		'width'=>500,
		'height'=>300
	),
));?>

<span style="float:left;"><?php //MessageHandler:: ?></span>
<input type="text" id="<?php echo $busqueda ?>" name="<?php echo $busqueda ?>" size="30" value="">
<input type="hidden" id="<?php echo $modelo ?>" name="<?php echo $modelo ?>" size="30" value="<?php echo $modelo; ?>">
<input type="hidden" id="<?php echo $obj_fk ?>" name="<?php echo $obj_fk ?>" size="30" value="<?php echo $obj_fk; ?>">
<input type="hidden" id="<?php echo $obj_name ?>_1" name="<?php echo $obj_name ?>_1" size="30" value="<?php echo $obj_name; ?>">
<button onclick="<?php echo 'buscar'.$modelo.$id.'()'; ?>">Buscar</button>
<button onclick="<?php echo 'quitar'.$modelo.$id.'()'; ?>">Quitar</button>
<hr>

<div id="<?php echo $modelo.$id ?>_div"></div>

<?php 
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$cs->registerScript('js_modelo_'.$id,
"
function buscar".$modelo.$id."() {        
        var tipo_identificacion = $('#tipo_identificacion').val();
        if(tipo_identificacion=='')
            tipo_identificacion=0;
	var nombre = $('#$busqueda').val();
        var modelo = $('#$modelo').val();
        var obj_fk = $('#$obj_fk').val();
        var obj_name = $('#".$obj_name."_1').val();
        var id='$id';
	var urllista = '$url_lista';
        var data={
            nombre:nombre,
            modelo:modelo,
            obj_fk:obj_fk,
            obj_name:obj_name,
            tipo_identificacion:tipo_identificacion,
            id:id
            }
	$('#".$modelo.$id."_div').text('buscando...');
	$('#".$modelo.$id."_div').load('$url_lista', data, function(){
		if('$openCallback') {
			if(!jQuery.isFunction($openCallback))
				alert('Ciudades: callback open no es una función valida');
			else
				$openCallback(nombre);
		} 
	});
}

function quitar".$modelo.$id."(){
	if(!'$selectCallback')
		return;
	if(!jQuery.isFunction($selectCallback))
		alert('Ciudades: callback select no es una función valida');
	else
		$selectCallback(null, null, null, null);
}
		
function select".$modelo.$id."(fk, nombre,objfk,name,autorizacionFactura,caducidadFactura) {
	if(!'$selectCallback')
		return;
	if(!jQuery.isFunction($selectCallback))
		alert('Ciudades: callback select no es una función valida');
	else
		$selectCallback(fk, nombre,objfk,name,autorizacionFactura,caducidadFactura);
}

$('#$busqueda').keydown(function(event) {
	if (event.keyCode == '13') {
		event.preventDefault();
		buscar".$modelo.$id."();
	}
});
", CClientScript::POS_END); ?>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>