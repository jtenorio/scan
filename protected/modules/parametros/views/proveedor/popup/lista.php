<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<?php ?>
<table width="100%">
    <thead>
    <th>Ruc/Cedula</th>
    <th>Razon Social</th>
    </thead>
    <tbody>
    <?php if(count($lista)>0):?>

            <?php foreach ($lista as $key =>$value):
            $js="select".$modelo.$id."('".$value->id."','".trim($value->cedularuc).' | '.trim($value->razonsocial)."','".$modelo."_".$obj_fk."','".$obj_name."','".$value->autorizacionfactura."','".$value->fechacaducidad."')";
            ?>
            <tr>
            <td><?php  echo CHtml::link($value->cedularuc,'javascript:'.$js); ?></td>
            <td><?php echo $value->razonsocial;?></td>

            </tr>
            <?php endforeach;?>

    <?php else: ?>
        <tr>
            <td colspan="2">No se encontraron registros</td>
        </tr>
    <?php endif;?>
    </tbody>
</table>