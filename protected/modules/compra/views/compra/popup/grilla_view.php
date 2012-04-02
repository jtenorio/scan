<?php
$sql = "SELECT codigoproducto, nombre, cantidad, valorunitario, i.id as idprod, tarifaiva
        FROM detallecompra dc, item i, itembodega ib
        WHERE dc.iditembodega=ib.id AND ib.iditem=i.id AND idcompra=".$text;
$connection = Yii::app()->getDb();
$dataReader=$connection->createCommand($sql)->query();
echo '<script languaje="javascript">';
echo '$(document).ready(function(){';
$hidden = '';
foreach($dataReader as $row){
   echo 'agregarVer("'.$row['codigoproducto'].'","'.$row['nombre'].'","'.$row['cantidad'].'","'.$row['valorunitario'].'","","'.$row['idprod'].'",0,"'.$row['tarifaiva'].'"); ';
}
echo ' });
    calcularValores();</script> ';
?>
