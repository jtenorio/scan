<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>

<table width="100%">
    <thead>
    <th>Codigo Banco</th>
    <th>Nombre </th>
    </thead>
    <tbody>
    <?php if(count($lista)>0):?>
        
            <?php foreach ($lista as $key =>$value):
            $js="selectCuentabancariabanco_dlg('".$value->idbanco."','".trim($value->codigobanco).' | '.trim($value->nombre)."','".$modelo."_".$obj_fk."','".$obj_name."')";
            ?>
            <tr>
            <td><?php  echo CHtml::link($value->codigobanco,'javascript:'.$js); ?></td>
            <td><?php echo $value->nombre?></td>

            </tr>
            <?php endforeach;?>
        
    <?php else: ?>
        <tr>
            <td colspan="2">No se encontraron registros</td>
        </tr>
    <?php endif;?>
    </tbody>
</table>