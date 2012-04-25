<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_oportunidad')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_oportunidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_modificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tomacontacto')); ?>:</b>
	<?php echo CHtml::encode($data->tomacontacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_oportunidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_oportunidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_oportunidad')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_oportunidad); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_posiblecierre')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_posiblecierre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_realcierre')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_realcierre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etapa_venta')); ?>:</b>
	<?php echo CHtml::encode($data->etapa_venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probabilidad')); ?>:</b>
	<?php echo CHtml::encode($data->probabilidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cliente_id')); ?>:</b>
	<?php echo CHtml::encode($data->cliente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_sistema')); ?>:</b>
	<?php echo CHtml::encode($data->estado_sistema); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mediocontacto')); ?>:</b>
	<?php echo CHtml::encode($data->mediocontacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detallecontacto')); ?>:</b>
	<?php echo CHtml::encode($data->detallecontacto); ?>
	<br />

	*/ ?>

</div>