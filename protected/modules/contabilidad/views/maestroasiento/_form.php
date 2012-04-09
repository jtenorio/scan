
<div class="form" id="form">

    <span class="required"><?php echo isset($mensaje)?$mensaje:'';?></span>  
<?php 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'maestroasiento-form',
	'enableAjaxValidation'=>false,
)); 

?>
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
                <?php 
                
                echo $form->labelEx($model,'idcomprobantecontable',array('label'=>"Comprobante")); ?>	
                <?php echo $form->error($model,'idcomprobantecontable'); ?>
            </td>
        
            <td id="c_comprobante">
                <script type="text/javascript">
                    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/contabilidad/maestrocombos/comprobante/egresos/0/d/<?php echo $model->idcomprobantecontable?>', 'c_comprobante');
                </script>
                                                    
            </td>
            <td>
                <?php echo $form->labelEx($model,'numerocomprobante',array('label'=>"N&uacute;mero de Comprobante")); ?>		
            </td>
            <td>
                <?php 
                    if($model->isNewRecord ){
                        $numeroComp = $model->numerodocumento;
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
               
               
                echo $form->labelEx($model,'numerodocumento',array('label'=>"N&uacute;mero de Documento")); ?>
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
           <!-- <td>
                <?php echo $form->labelEx($model,'referenciaadicional',array('label'=>"Referencia")); ?>		
            </td>
            <td>
                <?php echo $form->textField($model,'referenciaadicional',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'referenciaadicional'); ?>
            </td>!-->
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
                <?php //echo $form->textField($model,'fechacreacion',array('value'=>date('Y-m-d'),'size'=>10)); ?>
		<?php echo $form->error($model,'fechacreacion'); ?>
            </td>
            <td>
            </td>
            <td>
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
                <?php echo $form->labelEx($model,'valormovimiento',array('label'=>"Monto")); ?>		
            </td>
            <td>
                <?php echo $form->textField($model,'valormovimiento',array('size'=>12,'maxlength'=>12,
                    'onchange'=>"
                        if(!isNumber(this.value)){
                            alert('No es una cantidad valida');
                            this.value = '';
                        }
                    ")); ?>
                <?php echo $form->error($model,'valormovimiento'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model,'beneficiario',array('label'=>"Responsable")); ?>		
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
                    sendPage('null', '".Yii::app()->request->baseUrl."/index.php/contabilidad/maestrocombos/autoMaestrAsiento/cuenta/'+$('#Maestroasiento_idcuentabancaria').val()
                    +'/valor/'+$('#Maestroasiento_valormovimiento').val()+'/detalle/'+$('#Maestroasiento_detalle').val(), 'crearDetalleAsiento');")); ?>
                <?php echo $form->error($model,'detalle'); ?>
            </td>                    
        </tr>
            
    </table>
 </div>
<!--cargar combos x default-->
<script type="text/javascript">
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/contabilidad/maestrocombos/documento/d/<?php echo $model->iddocumento?>/id/<?php echo $model->idcomprobantecontable?>', 'c_documento');
    sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/contabilidad/maestrocombos/banco/d/<?php echo $model->idcuentabancaria?>/id/<?php echo $model->iddocumento?>', 'c_banco');
</script>
    <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row buttons" id="botonCrear" style="<?php echo $model->isNewRecord?'display: none;':'' ?>">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>
   
<!--fin de cabecera-->
    <div id="crearDetalleAsiento">
        <!--detalle de los asientos temporales no se guarda ninguna data aún-->
    </div>
    
	
<?php if($model->isNewRecord ){?>
    <script type="text/javascript">
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestroasiento/detalle', 'crearDetalleAsiento');
    </script>
<?php }else{?>
    <script type="text/javascript">
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestroasiento/detalle/edit/<?php echo $model->idasiento?>/inicia/1', 'crearDetalleAsiento');
    </script>
    <p><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestroasiento/delete/id/<?php echo $model->idasiento?>">Anular Asiento</a></p>
<?php }

$this->endWidget();

?>	

<!-- form -->