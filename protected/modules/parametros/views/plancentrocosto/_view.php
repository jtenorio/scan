<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcuentagasto')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcuentagasto), array('view', 'id'=>$data->idcuentagasto)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuentagasto')); ?>:</b>
	<?php echo CHtml::encode($data->cuentagasto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombrecuenta')); ?>:</b>
	<?php echo CHtml::encode($data->nombrecuenta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipocuenta')); ?>:</b>
	<?php echo CHtml::encode($data->tipocuenta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nivelcuenta')); ?>:</b>
	<?php echo CHtml::encode($data->nivelcuenta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idempresa')); ?>:</b>
	<?php echo CHtml::encode($data->idempresa); ?>
	<br />


</div>