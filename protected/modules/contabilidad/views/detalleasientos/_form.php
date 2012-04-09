<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleasientos-form',
	'enableAjaxValidation'=>false,
)); ?>
<script>
	$(function() {
		var availableTags = [
		<?php 
		foreach($cuentasnec as $clientesArr){
			echo '"' .trim($clientesArr). '", ';
		}
		?>
		];
		$( "#autocompletado" ).autocomplete({
			source: availableTags,
			select: function( event, ui ) {
					$('#Detalleasientos_cuentacontable option[label="'+ui.item.label+'"]').attr('selected', 'selected');
                    //alert('->'+ui.item.label+'<-');
				}
		});
               
	
		
	});
    
</script>    
    <table>
        <tr>
            <td><?php echo $form->labelEx($model,'cuentacontable'); ?></td>
            <td><?php echo $form->labelEx($model,'valordebe'); ?></td>
            <td><?php echo $form->labelEx($model,'valorhaber'); ?></td>
            <td><?php echo $form->labelEx($model,'subdetalle'); ?></td>
            <td></td>
        </tr>
        <tr>
            <td>
                 <input type="text" name="autocompletado" id="autocompletado" value=""/>
                 <select name="Detalleasientos[cuentacontable]" id="Detalleasientos_cuentacontable" style="display: none;">
                     <?php 
                        foreach($cuentasnec as $val => $clientesArr){?>
                             <option value="<?php echo $val?>" label="<?php echo $clientesArr?>"><?php echo $clientesArr?></option>
                      <?php }
                      ?>
                    
                 </select>
                <?php //echo $form->dropDownList($model,'cuentacontable', $cuentasnec,array())?>
                <?php echo $form->error($model,'cuentacontable'); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'valordebe',array('size'=>10,'maxlength'=>7,)); ?>
                <?php echo $form->error($model,'valordebe'); ?>                
            </td>
            <td>
                <?php echo $form->textField($model,'valorhaber',array('size'=>10,'maxlength'=>7,)); ?>
                <?php echo $form->error($model,'valorhaber'); ?>                
            </td>
            <td>
                <?php echo $form->textField($model,'subdetalle',array('size'=>60,'maxlength'=>120,'size'=>30,'value'=>$detalle)); ?>                
                <?php //echo $form->error($model,'subdetalle'); ?>                
            </td>
            <td style="display: none">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
            </td>
        </tr>
    </table>
	<?php echo $form->errorSummary($model); ?>

<!--<div class="row">
		<?php echo $form->labelEx($model,'idasiento'); ?>
		<?php echo $form->textField($model,'idasiento'); ?>
		<?php echo $form->error($model,'idasiento'); ?>
	</div>-->
	
<!--	<div class="row">
		<?php echo $form->labelEx($model,'idempresa'); ?>
		<?php echo $form->textField($model,'idempresa'); ?>
		<?php echo $form->error($model,'idempresa'); ?>
	</div>-->

	<div class="row buttons">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div id="listDetalleAsiento">
    
   <?php
//        $this->widget('zii.widgets.grid.CEditableGridView', array(
//                     'dataProvider'=>$model->search(),
//                     'showQuickBar'=>'true',
//                     'quickCreateAction'=>'create', // will be actionQuickCreate()
//                     'columns'=>array(
//                            
//                            array('header' => 'Detalle', 'name' => 'subdetalle', 'class' => 'CEditableColumn')
//                     )));
   ?>
    <script type="text/javascript">
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/detalleasientos/index/idCabecera/<?php echo $idCabecera?>', 'listDetalleAsiento');
    </script>
</div>