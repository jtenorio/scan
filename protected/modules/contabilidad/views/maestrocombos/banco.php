<select name="Maestroasiento[idcuentabancaria]" id="Maestroasiento_idcuentabancaria" onchange="">
        
    <?php
        foreach($cuentasArray as $id=>$text)
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

<?php
if(!is_null($numeroDoc)){
    ?>
<script type="text/javascript">
     $("#Maestroasiento_numerodocumento").val('#');
     $("#Maestroasiento_numerodocumento").attr('readonly','readonly');
</script>

<?php
}else{
?>
<script type="text/javascript">
    //$("#Maestroasiento_numerodocumento").val('');
    $("#Maestroasiento_numerodocumento").removeAttr('readonly');
</script>
<?php
}
?>