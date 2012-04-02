
<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

?>


<h1><?php echo MessageHandler::transformar('Modulo','Parametros','TipoComprobante'); ?></h1>
<?php $this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Crear', array('tipocomprobante/crear')),
	),
));?>
<br>
<?php
$this->widget('ListaModulosWidget',array('model'=>$model,'id'=>'tipo-comprobante'));
?>
