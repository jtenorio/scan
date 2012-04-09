<table border="1">
    <tr style="background-color: green;">
        <td colspan="5">ANTICIPOS</td>
    </tr>
    <tr>
        <td>Fecha</td>
        <td>Num. Egreso</td>
        <td>Valor Anticipo</td>
        <td>Pagado</td>
        <td>Saldo</td>
    </tr>
    <?php
    foreach($data as $item){
    ?>
    <tr id="ant_<?php echo $item->id?>" style="cursor:pointer;" onclick="
        sendPage('null', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/detalle/anticipo/<?php echo $item->id?>/valor/<?php echo $item->valoranticipo?>/proveedor/<?php echo $item->idproveedor?>/cuenta1/'+$('#Maestroasiento_idcuentabancaria').val(), 'crearDetalleAsiento');
        $('#ant_<?php echo $item->id?>').fadeOut(1200);    
                ">
        <td><?php echo $item->fecha?></td>
        <td><?php echo $item->numeroegreso?></td>
        <td><?php echo $item->valoranticipo?></td>
        <td><?php echo $item->pagadoanticipo>0?$item->pagadoanticipo:0;?></td>
        <td><?php echo $item->saldoanticipo>0?$item->saldoanticipo:0;?></td>     
    </tr>
    <?php }?>
</table>
