<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>

<h1><?php echo MessageHandler::transformar('Modulo','Parametros','Empresa'); ?></h1>

<?php $this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Crear', array('empresa/crear')),
	),
));?>
<br>
<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
$this->widget('ListaModulosWidget',array('model'=>$model,'id'=>'empresa'));
?>
