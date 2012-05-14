
<select name="<?php echo $name ?>" id="<?php echo $id ?>">
    <?php
    foreach ($data as $value => $text) {
        $selectedVal = $value == $selected ? 'selected' : '';
        ?>
        <option value="<?php echo $value ?>" <?php echo $selectedVal ?>><?php echo $text ?></option>
        <?php
    }
    ?>
</select>



