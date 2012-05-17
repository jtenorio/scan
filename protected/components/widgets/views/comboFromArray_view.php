
<select name="<?php echo $name ?>" id="<?php echo $id ?>" onchange="
<?php if ($dependencia) { ?>
                            sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/dependenceCombo/index/key/'+this.value+'/name/<?php echo $dependenciaData['name'] ?>/id/<?php echo $dependenciaData['id'] ?>/label/<?php echo $dependenciaData['label'] ?>/selected/<?php echo $dependenciaData['selected'] ?>', 'dependeceCombo_<?php echo $id ?>');
<?php } ?>
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

<div id="dependeceCombo_<?php echo $id ?>"></div>

<?php if ($dependencia) { ?>
    <script type="text/javascript">
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/dependenceCombo/index/key/'+$('#<?php echo $id ?>').val()+'/name/<?php echo $dependenciaData['name'] ?>/id/<?php echo $dependenciaData['id'] ?>/label/<?php echo $dependenciaData['label'] ?>/selected/<?php echo $dependenciaData['selected'] ?>', 'dependeceCombo_<?php echo $id ?>');
    </script>
<?php
}?>