<select name="Maestroasiento[iddocumento]" id="Maestroasiento_iddocumento" onchange="
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrocombos/banco/id/'+this.value, 'c_banco');
    ">
        <option value="">Seleccione</option>
    <?php
        
        foreach($documentoData as $id=>$text)
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
