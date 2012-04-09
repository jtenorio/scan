<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.views
 */

?>
<h1><?php echo MessageHandler::transformar('Modulo','Parametros','Plancuentasnec'); ?></h1>
<?php $this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Crear', array('plancuentasnec/crear')),
	),
));?>
<br>
<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
$this->widget('ListaModulosWidget',array('model'=>$model,'id'=>'plancuentasnec'));
?>
