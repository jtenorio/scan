<?php Yii::app()->clientScript->registerScriptFile("$this->root/scripts/jquery.form.js"); ?>

<?php
$this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Regresar', array('index')),
	),
));
?>

<h4>Cargar catálogo desde archivo</h4>

<p>
Seleccione un archivo de Excel con el formato definido para actualizar el catálogo general en forma masiva. 
</p>

<?php echo CHtml::form('cargar', 'post', array('id'=>'form_carga', 'enctype' => 'multipart/form-data'));?>
<label>Archivo Excel</label>
<?php echo CHtml::fileField('archivo', '', array('size'=>60));?>
<br>
<?php echo CHtml::submitButton('Cargar'); ?>

<?php echo CHtml::endForm(); ?>

<hr>

<b>Formato de Archivo de Excel</b> <br>
La información es una tabla con encabezados en la primera hoja, es decir los datos se leen
a partir de la fila 2.<br> 
Las columnas son:
<ul>
<li>Clase: Tipo general o contexto del item</li>
<li>Codigo: Código único de identificación del item</li>
<li>Valor: Cadena de texto con el valor del item, puede ser cualquier cosa</li>
<li>Cod_padre: Código del padre, si existe. NOTA: el código depende del contexto y la aplicación la resuelve automaticamente</li>
<li>Descripcion: Información adicional del item, opcional</li>
</ul>

NOTA:
Los códigos de los padres se resuelven automáticamente dependiendo del contexto. Por ejemplo, si un item de tipo 'ciudad' tiene como código
del padre '50', el sistema buscará el código en los tipos 'provincia' porque esa jerarquía está definida internamente.

<hr>
<?php echo CHtml::image("$this->root/images/ajax-loader.gif", '', array('style'=>'display:none;', 'id'=>'loader'))?>
<div id='message'></div>

<script type="text/javascript">
<!--
$(document).ready(function() {
	var options = {
		target: '#message', //Div tag where content info will be loaded in
		url: '<?php echo CHtml::normalizeUrl(array('cargaAjax')); ?>', //The php file that handles the file that is uploaded
		beforeSubmit: function() {
			$('#message').html('Cargando...');
			$('#loader').show(); //Including a preloader, it loads into the div tag with id uploader
		},
		complete: function() { // puede ser success si hay algo que hacer cuando termine
			$('#loader').hide();
		}
	};
	
	$('#form_carga').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});

}); 
 //-->
</script>
