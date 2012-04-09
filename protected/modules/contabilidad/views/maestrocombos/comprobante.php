<select name="Maestroasiento[idcomprobantecontable]" id="Maestroasiento_idcomprobantecontable" onchange="
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrocombos/documento/id/'+this.value+'/d/<?php echo $default?>', 'c_documento');
    ">
    <option value="">Seleccione</option>
    <?php
        
        foreach($comprobanteData as $id=>$text)
        {
            if($id==$default){
                $selected = 'selected';
            }else{
                $selected = '';
            }       
            ?>
                <option value="<?php echo $id?>" <?php echo $selected?>><?php echo $text?></option>
            <?php
        }
    ?>
</select>
