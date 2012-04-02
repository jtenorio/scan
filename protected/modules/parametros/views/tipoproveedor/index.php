<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.views
 */

?>
<h1><?php echo MessageHandler::transformar('Modulo','Parametros','TipoProveedor'); ?></h1>
<?php $this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Crear', array('tipoproveedor/crear')),
	),
));?>
<br>
<?php
$this->widget('ListaModulosWidget',array('model'=>$model,'id'=>'tipo-proveedor'));
?>
