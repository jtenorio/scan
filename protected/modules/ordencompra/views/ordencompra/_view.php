<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaingreso')); ?>:</b>
	<?php echo CHtml::encode($data->fechaingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detalle')); ?>:</b>
	<?php echo CHtml::encode($data->detalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numeroorden')); ?>:</b>
	<?php echo CHtml::encode($data->numeroorden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anulado')); ?>:</b>
	<?php echo CHtml::encode($data->anulado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuario')); ?>:</b>
	<?php echo CHtml::encode($data->idusuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuarioaprueba')); ?>:</b>
	<?php echo CHtml::encode($data->idusuarioaprueba); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaaprueba')); ?>:</b>
	<?php echo CHtml::encode($data->fechaaprueba); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idproveedor')); ?>:</b>
	<?php echo CHtml::encode(Proveedor::model()->buscaRucNombre($data->idproveedor)); ?>
	<br />
</div>