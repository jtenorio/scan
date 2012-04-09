<?php
/**
 * Vista que despliega una lista de datos de cualquier tabla de la base de datos
 * la lista se mostrara en la parte izquierda de la pantalla.
 * Tiene la particularidad de hacer una busqueda dependiendo del parametro pasado
 * en la declaracion del widget , esto le de la opcion al usuario de buscar
 * para escoger el parametro
 *
 * @author Jose Sambrano
 * company B.O.S
 */
//var_dump(array_values($botones));src="<?php echo $path."/images/imagenes/".$botones[$value]["image_name"].".png" 
?>
<div id="botones">
<?php if (is_array($permitidos)):?>
    <?php foreach ($permitidos as $value):?>
        <?php if ($botones[$value]): ?>
        <?php //echo $path."/images/imagenes/".$botones[$value]["image_name"].".png";?>
            <div id="<?php echo $botones[$value]["id"]; ?>"><input type="submit"  id="button_<?php echo $botones[$value]["id"]; ?>" name="button_<?php echo $botones[$value]["id"]; ?>" value="<?php echo $botones[$value]["id"]; ?>"></div>
         <?php endif;?>
     <?php endforeach;?>
<?php endif; ?>
</div>
<!--
    <div id="new">
        <input type="image" src="<?php //echo $path_new ;?>" name >
    </div>
    <div id="save">
        <input type="image" src="<?php //echo $path_save ;?>" >
    </div>/
    <div id="modify">
        <input type="image" src="<?php //echo $path_modify ;?>" >
    </div>
    <div id="delete">
        <input type="image" src="<?php //echo $path_delete ;?>" >
    </div>
    <div id="exit">
        <input type="image" src="<?php //echo $path_exit ;?>">
    </div>
</div>-->