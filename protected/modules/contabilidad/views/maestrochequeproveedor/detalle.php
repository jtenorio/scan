<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleasientosform',
	'enableAjaxValidation'=>false,
)); 


 $session=new CHttpSession;
 $session->open();
 
?>
<script>
     function isNumber(n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
    }
	$(function() {
		var availableTags = [
		<?php 
		foreach($session['maestroCuentasC']  as $clientesArr){
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
        </tr>
        <tr style="<?php echo is_null($editar)?'':'background-color: orange;';?>">
            <td>
                 <input type="text" name="autocompletado" id="autocompletado" value="<?php                  
                   echo is_null($editar)?'':$session['detalle_asiento_temp'][$editar]['nombre'];
                   ?>" onblur="if($('#Detalleasientos_cuentacontable').val()==''){
                       this.value='';
                   }"
                   onclick="this.value=''; $('#Detalleasientos_cuentacontable').val('');"/>
                 <input type="hidden" value="" name="Detalleasientos[cuentacontable]" id="Detalleasientos_cuentacontable">
                
                <?php //echo $form->dropDownList($model,'cuentacontable', $cuentasnec,array())?>
                <?php echo $form->error($model,'cuentacontable'); ?>
            </td>
            <td>
                <?php 
                $value = is_null($editar)?'':$session['detalle_asiento_temp'][$editar]['valordebe'];
                echo $form->textField($model,'valordebe',array('size'=>10,'maxlength'=>7,
                    'onchange'=>"$('#Detalleasientos_valorhaber').val(0);
                        if(!isNumber(this.value)){
                            alert('No es una cantidad valida');
                            this.value = '';
                        }
                    ",'value'=>$value)); ?>
                <?php echo $form->error($model,'valordebe'); ?>                
            </td>
            <td>
                <?php 
                $value = is_null($editar)?'':$session['detalle_asiento_temp'][$editar]['valorhaber'];
                echo $form->textField($model,'valorhaber',array('size'=>10,'maxlength'=>7,
                    'onchange'=>"$('#Detalleasientos_valordebe').val(0);
                        if(!isNumber(this.value)){
                            alert('No es una cantidad valida');
                            this.value = '';
                        }
                    ",'value'=>$value)); ?>
                <?php echo $form->error($model,'valorhaber'); ?>                
            </td>
            <td>
              
                <?php 
                $value = is_null($editar)?'':$session['detalle_asiento_temp'][$editar]['subdetalle'];
                echo $form->textField($model,'subdetalle',array('size'=>60,'maxlength'=>120,'size'=>30,'value'=>$subdetalle,
                    'value'=>$value)); ?>
                <?php echo $form->error($model,'subdetalle'); ?>                
            </td>
            <td style="">
                <?php if(is_null($editar)){?>                
                <input type="button" value="+" name="add" onclick="  
                    if($('#Detalleasientos_cuentacontable').val()!='')
                    loadPageAjax('detalleasientosform', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestroasiento/detalle', 'crearDetalleAsiento');                    
                 " 
                />
                <?php }else{?>      
                <input type="button" value="e" name="add" onclick="  
                    if($('#Detalleasientos_cuentacontable').val()!='')
                    loadPageAjax('detalleasientosform', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestroasiento/detalle/editar/<?php echo $editar?>', 'crearDetalleAsiento');                    
                 " 
                />
                <?php }?>
            </td>
        </tr>
    </table>
<?php $this->endWidget(); 
        $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detalleasientosformnoused',
	'enableAjaxValidation'=>false,
)); 
?>
    <table>
        <tr>
            <td colspan="4">
                <?php
                      $session=new CHttpSession;
                      $session->open();

                      $totalDebe = 0;
                      $totalHaber =0;
                      $i=0;
                      
                      if(isset($session['detalle_asiento_temp'])){
                         //imprimir la tabla de asientos
                          //print_r($session['detalle_asiento_temp']);
                          ?>
                              <table>
                                  <?php 
                                    
                                    
                                    foreach($session['detalle_asiento_temp'] as $row){
                                        $totalDebe += $row['valordebe'];
                                        $totalHaber += $row['valorhaber'];                                   
                                        ?>
                                  <tr style="cursor: pointer;" onclick="
                                     loadPageAjax('detalleasientosform', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestroasiento/detalle/editar/<?php echo $i?>', 'crearDetalleAsiento');
                                                                        ">
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $row['valordebe']; ?></td>
                                            <td><?php echo $row['valorhaber']; ?></td>
                                            <td><?php echo $row['subdetalle']; ?></td>
                                            <td><a onclick="
                                               if(confirm('Desea eliminar este detalle?'))
                                                   {
                                                       loadPageAjax('detalleasientosform', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestroasiento/detalle/delete/<?php echo $i?>', 'crearDetalleAsiento');
                                                   }
                                               ">[X]</a></td>
                                        </tr>
                                        <?php   
                                        $i++;
                                    }
                                    ?>
                                         <tr >
                                            <td></td>
                                            <td><?php echo $totalDebe?></td>
                                            <td><?php echo $totalHaber?></td>
                                            <td style="background-color: red;"><?php echo $totalDebe-$totalHaber?></td>
                                        </tr> 
                              </table>
                          <?php
                      }

                ?>
                
            </td>
        </tr>
    </table>
	<?php echo $form->errorSummary($model); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
if($totalDebe-$totalHaber == 0 && $i > 0)
{
    ?>
<script type="text/javascript">
    $('#botonCrear').fadeIn(500);
</script>

<?php
}else{
?>
<script type="text/javascript">
    $('#botonCrear').fadeOut(500);
</script>
<?php } ?>

<script type="text/javascript">
    detalle = $('#Maestroasiento_detalle').val();
    $('#Detalleasientos_subdetalle').val(detalle);   
    
    $('#Maestroasiento_valormovimiento').val('<?php echo $valor?>');
</script>