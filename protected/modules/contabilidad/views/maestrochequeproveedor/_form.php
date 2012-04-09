<script>
	$(function() {
		var availableTags = [
		<?php 
        $i=0;
		foreach($proveedorByRuc as $id =>$ruc){        
			echo '{"value":"'.trim($ruc).'","label": "' .trim($ruc). '", "id":"'.$i.'","idp":"'.$id.'"}, ';
            $i++;
		}
		?>
		];
        
        var availableTagsName = [
		<?php 
        $i=0;
		foreach($proveedorByName as $id => $ruc){
			echo '{"value":"'.trim($ruc).'","label": "' .trim($ruc). '", "id":"'.$i.'","idp":"'.$id.'"},';
            $i++;
		}
		?>
		];
        
        
		$( "#Maestroasiento_cedularuc" ).autocomplete({
			source: availableTags,
			select: function( event, ui ) {
					
                    $('#Maestroasiento_beneficiario').val(availableTagsName[ui.item.id].label);
                    $('#idProveedor').val(availableTagsName[ui.item.id].idp);
                    sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/anticipos/idProveedor/'+availableTagsName[ui.item.id].idp, 'anticipos');
                    sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/compras/idProveedor/'+availableTagsName[ui.item.id].idp, 'compras');
                    $('#Maestroasiento_detalle').val(availableTagsName[ui.item.id].label + ' AB/CANC');
				}
		});
               
        
		$( "#Maestroasiento_beneficiario" ).autocomplete({
			source: availableTagsName,
			select: function( event, ui ) {
					$('#Maestroasiento_cedularuc').val(availableTags[ui.item.id].label);
                    $('#idProveedor').val(availableTagsName[ui.item.id].idp);
                    sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/anticipos/idProveedor/'+availableTagsName[ui.item.id].idp, 'anticipos');
                    sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/compras/idProveedor/'+availableTagsName[ui.item.id].idp, 'compras');
                    $('#Maestroasiento_detalle').val($('#Maestroasiento_beneficiario').val() + ' AB/CANC');
				}
		});
		
	});
    
</script>
<div style="display: none;">
<?php
//cuadro de dialogo

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'dialogProveedores',    
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Listado de proveedores',
        'autoOpen'=>false,
        
    ),
    
));
$content = "";
    $content .= '<table>';
        foreach($proveedorByRuc as $id =>$ruc){
            $content .= '<tr onclick="
                    $(\'#Maestroasiento_cedularuc\').val(\''.$ruc.'\');
                    $(\'#Maestroasiento_beneficiario\').val(\''.$proveedorByName[$id].'\');
                    $(\'#idProveedor\').val(\''.$id.'\');
                    $(\'#dialogProveedores\').dialog(\'close\');
                    sendPage(\'null\', \''.Yii::app()->request->baseUrl.'/index.php/contabilidad/maestrochequeproveedor/anticipos/idProveedor/'.$id.'\', \'anticipos\');
                    sendPage(\'null\', \''.Yii::app()->request->baseUrl.'/index.php/contabilidad/maestrochequeproveedor/compras/idProveedor/'.$id.'\', \'compras\');
                    $(\'#Maestroasiento_detalle\').val($(\'#Maestroasiento_beneficiario\').val()+ \' AB/CANC\');
                " style="cursor:pointer;">';
                $content .= "<td>$ruc</td>";
                $content .= "<td>{$proveedorByName[$id]}</td>";
            $content .= '</tr>';
        }


    $content .= '</table>';
echo $content;
$this->endWidget('zii.widgets.jui.CJuiDialog');

?>
</div>

<div class="form">

<span class="required"><?php echo isset($mensaje)?$mensaje:'';?></span>  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maestroasiento-form',
	'enableAjaxValidation'=>false,
)); 

?>
<input type="hidden" value="<?php echo is_null($idProveedor)?'':$idProveedor?>" name="idProveedor" id="idProveedor"></input>
    <table>         
        <tr>
            <td colspan="2">
                <?php echo $form->labelEx($model,'numeroasiento',array('label'=>"N&uacute;mero de Asiento",)); ?>                 
            </td>
            <td  colspan="2">
                <?php 
                    if($model->isNewRecord ){
                        $numero = '';
                    }else{
                        $numero = $model->numeroasiento;
                    }
                    echo $form->textField($model,'numeroasiento',array('size'=>10,'maxlength'=>10,'value'=>$numero,
                    'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'numeroasiento'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model,'idcomprobantecontable',array('label'=>"Comprobante")); ?>	
                <?php echo $form->error($model,'idcomprobantecontable'); ?>
            </td>
        
           <td id="c_comprobante">
                <script type="text/javascript">
                    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/contabilidad/maestrocombos/comprobante/egresos/1/d/<?php echo $model->idcomprobantecontable?>', 'c_comprobante');
                </script>
                                                    
            </td>
            <td>
                <?php echo $form->labelEx($model,'numerocomprobante',array('label'=>"N&uacute;mero de Comprobante")); ?>		
            </td>
            <td>
                <?php 
                if($model->isNewRecord ){
                        $numeroComp = '';
                    }else{
                        $numeroComp = $model->numerocomprobante;
                    }
                echo $form->textField($model,'numerocomprobante',array('size'=>10,'maxlength'=>10,'value'=>$numeroComp,
                    'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'numerocomprobante'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model,'iddocumento',array('label'=>"Documento")); ?>
                <?php echo $form->error($model,'iddocumento'); ?>
            </td>
            <td id="c_documento">                
                                
            </td>
            
            <td>
                <?php 
               
               
                echo $form->labelEx($model,'numerodocumento',array('label'=>"Numero de Documento")); ?>
            </td>
            <td>
                <?php
                 $options = array('size'=>10,'maxlength'=>10,);
                 if($model->isNewRecord ){
                        if(!is_null($numeroDoc)){
                            $options['value']= '#';
                            $options['readonly']= 'readonly';
                        }
                    }else{
                        //$options['value']= $model->numerodocumento;
                        $options['readonly']= 'readonly';
                    }
                echo $form->textField($model,'numerodocumento',$options); ?>
		<?php echo $form->error($model,'numerodocumento'); ?>
            </td>
        </tr>
                       
        <tr>
            <td>
                <?php echo $form->labelEx($model,'idcuentabancaria',array('label'=>"Cuenta Bancaria")); ?>
                <?php echo $form->error($model,'idcuentabancaria'); ?>
            </td>
            <td id="c_banco">
                               
            </td>
            <td>
                <?php echo $form->labelEx($model,'valormovimiento',array('label'=>"Valor")); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'valormovimiento',array('size'=>12,'maxlength'=>12,'readonly'=>'readOnly')); ?>
                <?php echo $form->error($model,'valormovimiento'); ?>
            </td>
        </tr>
       
         <tr>
           <td>
                <?php echo $form->labelEx($model,'cedularuc',array('label'=>"Cedula/RUC")); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'cedularuc',array('size'=>14,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'cedularuc'); ?>
                <?php
                    echo CHtml::link('Buscar', '#', array(
                       'onclick'=>'$("#dialogProveedores").dialog("open"); return false;',
                    ));
                ?>
            </td>
            <td >
                <?php echo $form->labelEx($model,'fechacreacion',array('label'=>"Fecha")); ?>
            </td>
            <td >
                <?php
                    $valorFacha = strlen($model->fechacreacion)>1?$model->fechacreacion:date('Y-m-d');
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name'=>'Maestroasiento[fechacreacion]',
                                    'value'=>$valorFacha,
                                    
                                    // additional javascript options for the date picker plugin
                                    'options'=>array(
                                        'showAnim'=>'fold',
                                        'dateFormat'=> 'yy-mm-dd',
                                        'changeMonth'=> true,
                                        'changeYear'=> true,            
                                        'showButtonPanel'=> true,
                                    ),
                                    'htmlOptions'=>array(
                                        'style'=>'height:20px;',
                                        'readonly'=>'readonly',
                                    ),
                                ));                
                ?>
		<?php echo $form->error($model,'fechacreacion'); ?>
            </td>
            
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model,'beneficiario',array('label'=>"Beneficiario")); ?>
            </td>
            <td colspan="3">
                <?php echo $form->textField($model,'beneficiario',array('size'=>60,'maxlength'=>80)); ?>
                <?php echo $form->error($model,'beneficiario'); ?>                
            </td>                                
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model,'detalle',array('label'=>"Concepto")); ?>
                
            </td>
            <td colspan="3">
                <?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>254,
                    'onchange'=>"$('#Detalleasientos_subdetalle').val(this.value)",
                    'onblur'=>"$('#Detalleasientos_subdetalle').val(this.value);
                                ")); ?>
                <?php echo $form->error($model,'detalle'); ?>
            </td>                    
        </tr>
            
    </table>
<script type="text/javascript">
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/contabilidad/maestrocombos/documento/d/<?php echo $model->iddocumento?>/id/<?php echo $model->idcomprobantecontable?>', 'c_documento');
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/contabilidad/maestrocombos/banco/d/<?php echo $model->idcuentabancaria?>/id/<?php echo $model->iddocumento?>', 'c_banco');
</script>
    <div id="crearDetalleAsiento">
        <!--detalle de los asientos temporales no se guarda ninguna data aún-->
    </div>

<div id="compras"></div>

<div id="anticipos"></div>





	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row buttons" id="botonCrear" style="<?php echo $model->isNewRecord?'display: none;':'' ?>">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>
<?php if($model->isNewRecord ){?>
    <script type="text/javascript">
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/detalle', 'crearDetalleAsiento');
    </script>
<?php }else{?>
    <script type="text/javascript">
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/detalle/edit/<?php echo $model->idasiento?>/inicia/1', 'crearDetalleAsiento');
    </script>
    <p><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/delete/id/<?php echo $model->idasiento?>">Anular Asiento</a></p>
<?php }$this->endWidget(); ?>	

    <script type="text/javascript">
        if($('#idProveedor').val() != '')
            {
                sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/anticipos/idProveedor/'+$('#idProveedor').val(), 'anticipos');
                sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/compras/idProveedor/'+$('#idProveedor').val(), 'compras');
            }
    </script>
    
</div><!-- form -->