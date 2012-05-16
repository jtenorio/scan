
<select name="<?php echo $name ?>" id="<?php echo $id ?>" onchange="
       
                ">
    <?php
    foreach ($data as $value => $text) {
        $selectedVal = $value == $selected ? 'selected' : '';
        ?>
        <option value="<?php echo $value ?>" <?php echo $selectedVal ?>><?php echo $text['text'] ?></option>
        <?php
    }
    ?>
</select>

<div id="dependeceCombo_<?php echo $id?>">

</div>



