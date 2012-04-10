<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaingreso')); ?>:</b>
	<?php echo CHtml::encode($data->fechaingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechamodificacion')); ?>:</b>
	<?php echo CHtml::encode($data->fechamodificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipodocumento')); ?>:</b>
	<?php echo CHtml::encode($data->tipodocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estadodocumento')); ?>:</b>
	<?php echo CHtml::encode($data->estadodocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('categoria')); ?>:</b>
	<?php echo CHtml::encode($data->categoria); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('subcategoria')); ?>:</b>
	<?php echo CHtml::encode($data->subcategoria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechapublicacion')); ?>:</b>
	<?php echo CHtml::encode($data->fechapublicacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechacaducidad')); ?>:</b>
	<?php echo CHtml::encode($data->fechacaducidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuario')); ?>:</b>
	<?php echo CHtml::encode($data->idusuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idequipo')); ?>:</b>
	<?php echo CHtml::encode($data->idequipo); ?>
	<br />

	*/ ?>

</div>