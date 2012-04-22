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

         $( "#<?php echo $ajaxFieldName?>" ).autocomplete({
			source: availableTags,
			select: function( event, ui ) {
                        }
                      })

        });
</script>

<!--real object for form-->

<select name="<?php echo $fieldName?>" style="display: none;">
    <?php
        foreach($data as $value =>$text){
            echo '<option value="'.$value.'">'.$text.'</option>';
        }
    ?>
</select>

