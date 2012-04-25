<script type="text/javascript">
	$(function() {
		var availableTags_<?php echo $ajaxFieldName?> = [
		<?php
                $i=0;
		foreach($data as $value =>$text){
			echo '{"value":"'.trim($text).'","label": "' .trim($text). '", "id":"'.$value.'"}, ';
             $i++;
		}
		?>
	];

         $( "#<?php echo $ajaxFieldName?>_text").autocomplete({
			source: availableTags_<?php echo $ajaxFieldName?>,
			select: function( event, ui ) {

                            //$('#<?php echo $ajaxFieldName?>_text').val(availableTags_<?php echo $ajaxFieldName?>[ui.item.id].label);
                            $('#<?php echo $ajaxFieldName?>').val(availableTags_<?php echo $ajaxFieldName?>[ui.item.id].id);
                        }
                      })

        });
</script>

<!--real object for form-->

<select name="<?php echo $fieldName?>"  id="<?php echo $ajaxFieldName?>" style="display: none;">
    <?php
        foreach($data as $value =>$text){
            echo '<option value="'.$value.'">'.$text.'</option>';
        }
    ?>
</select>

<input type="text" name="<?php echo $ajaxFieldName;?>" id="<?php echo $ajaxFieldName?>_text" value="" />

