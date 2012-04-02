<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Modulo','Parametros','CodigoRetencionFuente'); ?></h1>
<br>

<?php $this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Crear', array('codigoretencionfuente/crear')),
	),
));?>
<?php
$this->widget('ListaModulosWidget',array('model'=>$model,'id'=>'codigoretencionfuente'));
?>
