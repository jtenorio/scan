<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idasiento')); ?>:</b>
	<?php echo CHtml::encode($data->idasiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuentacontable')); ?>:</b>
	<?php echo CHtml::encode($data->cuentacontable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valordebe')); ?>:</b>
	<?php echo CHtml::encode($data->valordebe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valorhaber')); ?>:</b>
	<?php echo CHtml::encode($data->valorhaber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdetalle')); ?>:</b>
	<?php echo CHtml::encode($data->subdetalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idempresa')); ?>:</b>
	<?php echo CHtml::encode($data->idempresa); ?>
	<br />


</div>