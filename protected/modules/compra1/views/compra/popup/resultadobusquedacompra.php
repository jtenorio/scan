<script>
$(document).ready(function(){
    $("#tabla").dataTable( {
        "sPaginationType": "full_numbers"
    } );
});

</script>
<form name="form1" id="form1">
<table width='80%' border='1' class='display' id='tabla'>
<thead>
<tr>
    <th align='center'><strong>Número</strong></th>
    <th align='center'><strong>Fecha Emisión</strong></th>
    <th align='center'><strong>Establecimiento y Punto</strong></th>
    <th align='center'><strong>Secuencial</strong></th>
    <th align='center'><strong>Saldo</strong></th>
    <th align='center'><strong>Elegir</strong></th>
</tr>
</thead>
<tbody>
    <?php
    if($numeroCompra=='')
        $sql = "SELECT c.idcompra AS idCompras,numerocompratransaccion, fechaemision, estabcompra, puntocompra, secuencialcompra, saldocompra, autorizacompra, basecero, basegravada, basenograva, baseice, montoiva, montoice, idtipocomprobante, tc.descripcion AS tipocomprobantedescripcion
                FROM compraingreso c, proveedor p, compraingreso_cstm cstm, tipocomprobante tc
                WHERE c.idtipocomprobante=tc.id AND c.idproveedor=p.id AND c.idcompra=cstm.idcompra AND saldocompra>0 AND c.idproveedor=".$proveedor;
    else
        $sql = "SELECT c.idcompra AS idCompras,numerocompratransaccion, fechaemision, estabcompra, puntocompra, secuencialcompra, saldocompra, autorizacompra, basecero, basegravada, basenograva, baseice, montoiva, montoice, idtipocomprobante, tc.descripcion AS tipocomprobantedescripcion
                FROM compraingreso c, proveedor p, compraingreso_cstm cstm, tipocomprobante tc
                WHERE c.idtipocomprobante=tc.id AND c.idproveedor=p.id AND c.idcompra=cstm.idcompra AND saldocompra>0 AND c.idproveedor=".$proveedor." AND c.numerocompratransaccion=".$numeroCompra;
    $connection = Yii::app()->getDb();
    $dataReader=$connection->createCommand($sql)->query();
    if(count($dataReader)>0)
        foreach($dataReader as $row){
            echo '<tr>';
                echo '<td>'.$row['numerocompratransaccion'].'</td>';
                echo '<td>'.$row['fechaemision'].'</td>';
                echo '<td>'.$row['estabcompra'].' '.$row['puntocompra'].'</td>';
                echo '<td>'.$row['secuencialcompra'].'</td>';
                echo '<td>'.$row['saldocompra'].'</td>';
                $url = CHtml::normalizeUrl(array('Compra/buscarAjaxProductosVer'));
                echo "<td><a href='javascript:agregarCompra(\"$row[fechaemision]\",\"$row[estabcompra]\",\"$row[puntocompra]\",\"$row[secuencialcompra]\",\"$row[autorizacompra]\",\"$row[saldocompra]\",\"$row[idcompras]\",\"$url\",\"$row[basecero]\",\"$row[basegravada]\",\"$row[basenograva]\",\"$row[baseice]\",\"$row[montoiva]\",\"$row[montoice]\",\"$row[tipocomprobantedescripcion]\");'>Agregar</a>";
            echo '</tr>';
        }
    ?>
</tbody>
</table>
</form>