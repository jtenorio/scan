<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maestroasiento-form',
	'enableAjaxValidation'=>false,
)); 
    
?>

<table>
    <tr>
        <td colspan="3">
            <?php echo $form->labelEx($model,'numeroasiento',array('label'=>"Numero de Asiento")); ?>
        </td>
        <td clospaan="2">
            <?php echo $form->textField($model,'numeroasiento',array('size'=>10,'maxlength'=>10,'value'=>$model->getNuevoNumeroAsiento(),
                'readonly'=>'readonly')); ?>
            <?php echo $form->error($model,'numeroasiento'); ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <?php echo $form->labelEx($model,'idcomprobantecontable',array('label'=>"Comprobante")); ?>
        </td>
        <td>
            <?php echo $form->dropDownList($model,'idcomprobantecontable',
                    $comprobanteData,array('onchange'=>"document.forms['maestroasiento-form'].submit()")); ?>
            <?php echo $form->error($model,'idcomprobantecontable'); ?>
        </td>
      
        <td>
            <?php echo $form->labelEx($model,'numerocomprobante',array('label'=>"Numero de Comprobante")); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'numerocomprobante',array('size'=>10,'maxlength'=>10)); ?>
    		<?php echo $form->error($model,'numerocomprobante'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $form->labelEx($model,'fechacreacion',array('label'=>"Fecha")); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'fechacreacion',array('value'=>date('Y-m-d'),'size'=>10)); ?>
            <?php echo $form->error($model,'fechacreacion'); ?>
        </td>
        <td>
            Tipo Pago
        </td>
        <td>
            <select name="tipopago">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
        </td>
        <td>
            <?php echo $form->labelEx($model,'valormovimiento',array('label'=>"Monto")); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'valormovimiento',array('size'=>12,'maxlength'=>12)); ?>
            <?php echo $form->error($model,'valormovimiento'); ?> 
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $form->labelEx($model,'iddocumento',array('label'=>"Documento")); ?>
        </td>
        <td>
            <?php echo $form->dropDownList($model,'iddocumento',$documentoData); ?>
            <?php echo $form->error($model,'iddocumento'); ?>
        </td>
        <td>
            <?php echo $form->labelEx($model,'numerodocumento',array('label'=>"Numero de Documento")); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'numerodocumento',array('size'=>10,'maxlength'=>10)); ?>
            <?php echo $form->error($model,'numerodocumento'); ?>
        </td>
        <td>
            <?php echo $form->labelEx($model,'idcuentabancaria',array('label'=>"Cuenta Bancaria")); ?>
        </td>
        <td>
            <?php echo $form->dropDownList($model,'idcuentabancaria',$cuentasData); ?>
            <?php echo $form->error($model,'idcuentabancaria'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $form->labelEx($model,'cedularuc',array('label'=>"Cedula/Ruc")); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'cedularuc',array('size'=>13,'maxlength'=>13)); ?>
            <?php echo $form->error($model,'cedularuc'); ?>
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
            <?php echo $form->labelEx($model,'detalle'); ?>
        </td>
        <td colspan="3">
            <?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>254)); ?>
        	<?php echo $form->error($model,'detalle'); ?>
        </td>
    </tr>
</table>
    
	


    <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

