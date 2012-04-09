<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.views
 */
?>
<h1><?php echo MessageHandler::transformar('Modulo','Parametros','FormaPago'); ?></h1>
<?php $this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Crear', array('formapago/crear')),
	),
));?>
<br>
<?php
$this->widget('ListaModulosWidget',array('model'=>$model,'id'=>'forma-pago'));
?>
