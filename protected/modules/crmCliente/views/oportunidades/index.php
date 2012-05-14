<?php
$this->breadcrumbs=array(
	'Oportunidades',
);?>


<h2>Oportunidades vigentes con el cliente</h2>

<table>
    <tr>
        <td>Oportunidad</td>
        <td>Valor</td>
        <td>Fecha de cierre</td>
    </tr>

    <?php
    foreach ($oportunidades->getData() as $item) {
        //crmOportunidades/oportunidades/update/id/1
        ?>
        <tr onclick="">
            <td><?php echo $item->nombre_oportunidad?></td>
            <td><?php echo $item->cantidad_oportunidad?></td>
            <td><?php echo $item->fecha_posiblecierre?></td>
        </tr>
        <?php
    }
    ?>

</table>