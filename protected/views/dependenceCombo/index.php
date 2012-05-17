<p></p>
<label for="<?php echo $id ?>"><?php echo $label;?></label>
<select name="<?php echo $name ?>" id="<?php echo $id ?>">
    <?php
    foreach ($data as $value => $text) {
        $selectedVal = $value == $selected ? 'selected' : '';
        ?>
        <option value="<?php echo $value ?>" <?php echo $selectedVal  ?>><?php echo $text['text'] ?></option>
        <?php
    }
    ?>
</select>