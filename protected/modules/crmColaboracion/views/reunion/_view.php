<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asunto')); ?>:</b>
	<?php echo CHtml::encode($data->asunto); ?>
	<br />

<!--	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_ingreso); ?>
	<br />-->

<!--	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_modificacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_modificacion); ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lugar')); ?>:</b>
	<?php echo CHtml::encode($data->lugar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_inicio); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('fecha_fin')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_fin); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('estado_reunion')); ?>:</b>
	<?php
        switch ($data->estado_reunion)
            {
                case 0:
                    $estado='Pendiente';
                    break;
                case 1:
                    $estado='En ejecucion';
                    break;
                case 2:
                    $estado='Finalizada';
                    break;
                case 3:
                    $estado='Cancelada';
            }
        echo CHtml::encode($estado);
        
       ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('tiempo_recordatorio')); ?>:</b>
	<?php
        switch ($data->tiempo_recordatorio) {
            case 0:
                 $estado='No alertar';   
                break;
            case 1:
                 $estado='1 Dia';
                break;
            case 2:
                $estado='2 Dias';
                break;
            case 3:
                $estado='3 Dias';
                break;
            
        }
        echo CHtml::encode($estado); ?>
	<br />
    
    <p>
        <a onclick ="sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/reunion/update/id/<?php echo $data->id?>', 'colaboracion');">Editar</a>
    </p>
    
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_fin')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_fin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_fin_real')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_fin_real); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_reunion')); ?>:</b>
	<?php echo CHtml::encode($data->estado_reunion); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('padre_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->padre_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_sistema')); ?>:</b>
	<?php echo CHtml::encode($data->estado_sistema); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('padre_id')); ?>:</b>
	<?php echo CHtml::encode($data->padre_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuario')); ?>:</b>
	<?php echo CHtml::encode($data->idusuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idequipo')); ?>:</b>
	<?php echo CHtml::encode($data->idequipo); ?>
	<br />

	*/ ?>

</div>