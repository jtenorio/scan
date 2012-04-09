<script>
$(document).ready(function(){
    if($("#proveedor").val() == '')
        $("#Ordencompra_idproveedor").val("");
});
function escogerProveedor() {
    $("#modelo_dlg").dialog("open");
}
onSelectProveedor = function(fk,nombre,objfk,name,autorizacionFactura,fechaCaducidad){
    $("#Ordencompra_idproveedor").val(fk);
    $("#proveedor").val(nombre);
    $("#modelo_dlg").dialog("close");
}
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ordencompra-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

        <table width="100%">
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'numeroorden'); ?>
                </td>
                <td>
                    <?php 
                        if($model->isNewRecord)
                            echo $form->textField($model,'numeroorden',array('size'=>10,'maxlength'=>10));
                        else
                            echo $form->textField($model,'numeroorden',array('size'=>10,'maxlength'=>10,'readonly'=>'readonly'));
                    ?>
                    <?php echo $form->error($model,'numeroorden'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'detalle'); ?>
                </td>
                <td>
                    <?php echo $form->textField($model,'detalle',array('size'=>60,'maxlength'=>250)); ?>
                    <?php echo $form->error($model,'detalle'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'idproveedor'); ?>
                </td>
                <td>
                    <?php
                        if($model->isNewRecord)
                            echo CHtml::textField("proveedor", "", array("id" => "proveedor","size" => "50","readonly"=>"readonly"));
                        else
                            echo CHtml::textField("proveedor", Proveedor::model()->buscaRucNombre($model->idproveedor), array("id" => "proveedor","size" => "50","readonly"=>"readonly"));
                        echo CHtml::link('Escoger Proveedor','javascript:escogerProveedor();');
                    ?>
                    <?php echo $form->hiddenField($model,'idproveedor'); ?>
                    <?php echo $form->error($model,'idproveedor'); ?>
                </td>
            </tr>
            <?php 
            if($aprobar){
            ?>            
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'estado');?>
                </td>
                <td>
                    <?php echo $form->listBox($model,'estado',$estado,array('size'=>1)); ?>
                    <?php echo $form->error($model,'estado'); ?>
                </td>
            </tr>
            <?php }?>
        </table>
        <?php
            if($model->isNewRecord)
                $this->widget('GrillaordencompraWidget',array('text'=>'0','tipo'=>'crear'));
            else
                $this->widget('GrillaordencompraWidget',array('text'=>$model->id,'tipo'=>'modificar'));
        ?>
        <br/>
        <?php
        if($aprobar){
        ?>
        <table width="100%">
        <tr>
            <td width="20%">
                <?php echo $form->labelEx($model,'anulado');?>
            </td>
            <td>
                <?php echo $form->checkBox($model,'anulado'); ?>
                <?php echo $form->error($model,'anulado'); ?>
            </td>
        </tr>
        </table>
        <?php }?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>
<?php
$this->widget('ModelosWidget', array(
                'id' => 'modelo_dlg',
                'nombre' => '',
                'selectCallback' => 'onSelectProveedor',
                'title'=>'Seleccione Proveedor',
                'url_lista'=>'ordencompra/buscarAjaxProveedor',
                'modelo'=>'Proveedor',
                'obj_name'=>'razonsocial',
                'obj_fk'=>'id',
                'busqueda'=>'busquedaProveedor',
                'busqueda'=>'busquedaProveedor',
          ));
?>
<?php $this->endWidget(); ?>

</div><!-- form -->







