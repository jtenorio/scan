<script type="text/javascript">
	$(function() {
		var availableTags = [
		<?php
                $i=0;
		foreach($data as $value =>$text){
			echo '{"value":"'.trim($value).'","label": "' .trim($text). '", "id":"'.$i.'"}, ';
             $i++;
		}
		?>
	];

         $( "#<?php echo $ajaxFieldName?>_text").autocomplete({
			source: availableTags,
			select: function( event, ui ) {
                            $('#<?php echo $ajaxFieldName?>_text').val(availableTags[ui.item.id].label);
                            $('#<?php echo $ajaxFieldName?>').val(availableTags[ui.item.id].value);
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

